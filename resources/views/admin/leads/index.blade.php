@extends('admin.layout')

@section('title', 'Lead Submissions')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
    <h1 class="page-title" style="margin-bottom: 0;">Lead Submissions</h1>
    <a href="{{ route('admin.leads.export') }}" class="btn btn-success">Export Excel</a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    {{ $errors->first() }}
</div>
@endif

<div class="card">
    <div style="margin-bottom: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
        <span style="padding: 0.5rem 1rem; background: #e0f2fe; border-radius: 8px; font-weight: 600; color: #0369a1;">
            Total Leads: {{ $leads->total() }}
        </span>
        <span style="padding: 0.5rem 1rem; background: #dcfce7; border-radius: 8px; font-weight: 600; color: #15803d;">
            New: {{ App\Models\LeadSubmission::where('status', 'new')->count() }}
        </span>
        <span style="padding: 0.5rem 1rem; background: #fef3c7; border-radius: 8px; font-weight: 600; color: #92400e;">
            Contacted: {{ App\Models\LeadSubmission::where('status', 'contacted')->count() }}
        </span>
    </div>

    <form method="POST" action="{{ route('admin.leads.bulk') }}" id="bulk-form">
        @csrf

        <div id="bulk-actions" class="bulk-actions" hidden>
            <span id="selected-count" class="bulk-actions__count">0 selected</span>
            <select name="status" id="bulk-status" class="bulk-actions__select">
                <option value="">Change status…</option>
                <option value="new">New</option>
                <option value="contacted">Contacted</option>
                <option value="qualified">Qualified</option>
                <option value="converted">Converted</option>
                <option value="lost">Lost</option>
            </select>
            <button type="submit" name="action" value="update_status" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="return confirmBulkStatus()">
                Apply Status
            </button>
            <button type="submit" name="action" value="delete" class="btn btn-danger" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="return confirmBulkDelete()">
                Delete Selected
            </button>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 2.5rem;">
                        <input type="checkbox" id="select-all" title="Select all" aria-label="Select all leads">
                    </th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Landing Page</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leads as $lead)
                <tr>
                    <td>
                        <input type="checkbox" class="lead-checkbox" name="ids[]" value="{{ $lead->id }}" aria-label="Select {{ $lead->name }}">
                    </td>
                    <td>{{ $lead->name }}</td>
                    <td>{{ $lead->phone }}</td>
                    <td>
                        <span style="padding: 0.4rem 0.8rem; background: linear-gradient(135deg, #42b883 0%, #35495e 100%); color: white; border-radius: 6px; font-size: 0.85rem; font-weight: 500;">
                            {{ ucfirst($lead->landing_page) }}
                        </span>
                    </td>
                    <td>
                        <select
                            name="status"
                            form="status-form-{{ $lead->id }}"
                            class="status-select badge badge-{{ $lead->status }}"
                            onchange="this.className = 'status-select badge badge-' + this.value; document.getElementById('status-form-{{ $lead->id }}').submit();"
                            title="Click to change status"
                        >
                            <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>New</option>
                            <option value="contacted" {{ $lead->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                            <option value="qualified" {{ $lead->status === 'qualified' ? 'selected' : '' }}>Qualified</option>
                            <option value="converted" {{ $lead->status === 'converted' ? 'selected' : '' }}>Converted</option>
                            <option value="lost" {{ $lead->status === 'lost' ? 'selected' : '' }}>Lost</option>
                        </select>
                    </td>
                    <td>{{ $lead->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.leads.show', $lead) }}" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View</a>
                        <button type="submit" form="delete-form-{{ $lead->id }}" class="btn btn-danger" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="return confirm('Are you sure you want to delete this lead?')">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 3rem; color: #64748b;">
                        No lead submissions yet. Leads from landing pages will appear here.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </form>

    @foreach($leads as $lead)
    <form id="status-form-{{ $lead->id }}" method="POST" action="{{ route('admin.leads.update-status', $lead) }}" style="display: none;">
        @csrf
        @method('PATCH')
    </form>
    <form id="delete-form-{{ $lead->id }}" method="POST" action="{{ route('admin.leads.destroy', $lead) }}" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    @endforeach

    {{ $leads->links() }}
</div>

<style>
    .bulk-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1rem;
        padding: 0.85rem 1rem;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }

    .bulk-actions[hidden] {
        display: none;
    }

    .bulk-actions__count {
        font-weight: 600;
        color: #334155;
        margin-right: 0.25rem;
    }

    .bulk-actions__select {
        width: auto;
        min-width: 10rem;
        padding: 0.5rem 0.75rem;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        background: #fff;
        font-size: 0.9rem;
    }

    table tr.is-selected {
        background: #eff6ff;
    }
</style>

<script>
(function () {
    const selectAll = document.getElementById('select-all');
    const checkboxes = Array.from(document.querySelectorAll('.lead-checkbox'));
    const bulkActions = document.getElementById('bulk-actions');
    const selectedCount = document.getElementById('selected-count');
    const bulkStatus = document.getElementById('bulk-status');

    function updateBulkBar() {
        const selected = checkboxes.filter((cb) => cb.checked);
        const count = selected.length;

        selectedCount.textContent = count + ' selected';
        bulkActions.hidden = count === 0;

        checkboxes.forEach((cb) => {
            cb.closest('tr').classList.toggle('is-selected', cb.checked);
        });

        if (selectAll) {
            selectAll.checked = count > 0 && count === checkboxes.length;
            selectAll.indeterminate = count > 0 && count < checkboxes.length;
        }
    }

    if (selectAll) {
        selectAll.addEventListener('change', function () {
            checkboxes.forEach((cb) => {
                cb.checked = selectAll.checked;
            });
            updateBulkBar();
        });
    }

    checkboxes.forEach((cb) => {
        cb.addEventListener('change', updateBulkBar);
    });

    window.confirmBulkStatus = function () {
        const count = checkboxes.filter((cb) => cb.checked).length;
        if (!count) {
            alert('Select at least one lead.');
            return false;
        }
        if (!bulkStatus.value) {
            alert('Choose a status to apply.');
            return false;
        }
        return confirm('Update status for ' + count + ' lead(s) to "' + bulkStatus.options[bulkStatus.selectedIndex].text + '"?');
    };

    window.confirmBulkDelete = function () {
        const count = checkboxes.filter((cb) => cb.checked).length;
        if (!count) {
            alert('Select at least one lead.');
            return false;
        }
        return confirm('Delete ' + count + ' selected lead(s)? This cannot be undone.');
    };

    updateBulkBar();
})();
</script>
@endsection
