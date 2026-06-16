<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadSubmission;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LeadSubmissionController extends Controller
{
    public function index()
    {
        $leads = LeadSubmission::latest()->paginate(20);
        return view('admin.leads.index', compact('leads'));
    }

    public function show(LeadSubmission $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function updateStatus(Request $request, LeadSubmission $lead)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,qualified,converted,lost',
        ]);

        $lead->update($validated);

        return redirect()->back()->with('success', 'Lead status updated successfully!');
    }

    public function destroy(LeadSubmission $lead)
    {
        $lead->delete();
        return redirect()->route('admin.leads.index')->with('success', 'Lead deleted successfully!');
    }

    public function export(): StreamedResponse
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Lead Submissions');

        $headers = ['ID', 'Name', 'Phone', 'Project Idea', 'Landing Page', 'Status', 'Created At'];
        $sheet->fromArray($headers, null, 'A1');

        $row = 2;
        LeadSubmission::latest()->chunk(200, function ($leads) use ($sheet, &$row) {
            foreach ($leads as $lead) {
                $sheet->setCellValue('A'.$row, $lead->id);
                $sheet->setCellValue('B'.$row, $lead->name);
                $sheet->setCellValueExplicit('C'.$row, (string) $lead->phone, DataType::TYPE_STRING);
                $sheet->setCellValue('D'.$row, $lead->project_idea);
                $sheet->setCellValue('E'.$row, $lead->landing_page);
                $sheet->setCellValue('F'.$row, $lead->status);
                $sheet->setCellValue('G'.$row, $lead->created_at->format('Y-m-d H:i:s'));

                $this->applyCellTextAlignment($sheet, 'B'.$row, $lead->name);
                $this->applyCellTextAlignment($sheet, 'D'.$row, $lead->project_idea ?? '');

                $row++;
            }
        });

        $lastRow = max($row - 1, 1);

        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $filename = 'lead-submissions-'.now()->format('Y-m-d').'.xlsx';
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    private function containsArabicScript(string $text): bool
    {
        return (bool) preg_match('/[\x{0600}-\x{06FF}\x{0750}-\x{077F}\x{08A0}-\x{08FF}\x{FB50}-\x{FDFF}\x{FE70}-\x{FEFF}]/u', $text);
    }

    private function applyCellTextAlignment($sheet, string $cell, string $text): void
    {
        $alignment = $sheet->getStyle($cell)->getAlignment();

        if ($this->containsArabicScript($text)) {
            $alignment->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $alignment->setReadOrder(Alignment::READORDER_RTL);
        } else {
            $alignment->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $alignment->setReadOrder(Alignment::READORDER_LTR);
        }
    }
}
