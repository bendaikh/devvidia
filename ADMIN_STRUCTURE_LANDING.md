# Admin Panel Structure - Landing Pages System

## Two Separate Sections

### 1. Lead Submissions 📋
**Purpose**: View and manage leads captured from all landing pages

**Route**: `/admin/lead-submissions`

**Features**:
- View all lead submissions in one place
- Filter by landing page source
- Track lead status (New → Contacted → Qualified → Converted/Lost)
- Contact leads via WhatsApp
- View lead details and project ideas
- Delete leads
- Statistics: Total Leads, New, Contacted

**What you see**:
- Lead name, phone, project idea
- Which landing page the lead came from
- Lead status and timeline
- Quick actions (View, Delete, WhatsApp)

---

### 2. Landing Systems 🚀
**Purpose**: Create and manage the landing pages themselves

**Route**: `/admin/landing-systems`

**Features**:
- Create new landing pages
- Edit existing landing pages
- Toggle active/inactive status
- Track performance metrics per page:
  - Total views
  - Total submissions
  - Conversion rate (%)
- Choose templates (Systems, Custom, etc.)
- Manage URL slugs
- Preview landing pages

**What you see**:
- Landing page name and URL
- Template type
- Active/Inactive status
- Performance stats (Views, Submissions, Conversion %)
- Actions (View, Edit, Delete)

---

## Admin Sidebar Structure

```
Dashboard
Services
Projects
Contact Submissions
Lead Submissions          ← View all captured leads
Landing Systems          ← Manage landing pages themselves
WhatsApp Settings
API Integration
```

---

## Workflow Example

1. **Create a Landing Page** (Landing Systems section)
   - Go to Landing Systems
   - Click "Create New Landing Page"
   - Set name: "Healthcare Solutions"
   - Set slug: "healthcare"
   - Choose template
   - Save

2. **Landing Page is Live**
   - URL: `/landing/healthcare`
   - Visitors fill out the form
   - Views are automatically tracked

3. **Leads Are Captured** (Lead Submissions section)
   - Go to Lead Submissions
   - See all leads from all landing pages
   - Each lead shows which page it came from
   - Manage lead status through your sales funnel

---

## Key Differences

| Aspect | Lead Submissions | Landing Systems |
|--------|-----------------|-----------------|
| **Purpose** | Manage captured leads | Manage landing pages |
| **Data** | People who submitted forms | Landing page configurations |
| **Actions** | Contact, update status, delete | Create, edit, activate, delete pages |
| **Metrics** | Lead funnel progress | Views, submissions, conversion rate |
| **Focus** | Sales/CRM workflow | Marketing/page management |

---

## Current Setup

**Landing Pages Created**:
- Systems Development (`/landing/systems`)

**Templates Available**:
- Systems (default) - Focus on system development
- Custom - For future custom designs

**Lead Statuses**:
- New
- Contacted
- Qualified
- Converted
- Lost

---

Created: March 29, 2026
