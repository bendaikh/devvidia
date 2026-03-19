# Devvidia Admin Panel - Setup Complete

## Superadmin Credentials

**Email:** admin@devvidia.com  
**Password:** Devvidia@2026

## Admin Panel Access

**Login URL:** http://localhost:6500/admin/login

## Features Implemented

### 1. Database Structure
- **Admins Table**: Stores admin users with role-based access (superadmin/admin)
- **Services Table**: Manages landing page services (3 default services created)
- **Projects Table**: Manages landing page projects (6 default projects created)
- **Contact Submissions Table**: Stores contact form submissions from visitors

### 2. Admin Panel Sections

#### Dashboard (`/admin/dashboard`)
- Quick stats overview (Services count, Projects count, New submissions, Total submissions)
- Recent contact submissions list
- Easy navigation to all sections

#### Services Management (`/admin/services`)
- View all services
- Create new services
- Edit existing services (Icon, Title EN/FR, Description EN/FR, Order, Status)
- Delete services
- Toggle active/inactive status

#### Projects Management (`/admin/projects`)
- View all projects
- Create new projects
- Edit existing projects (Icon, Name, Description EN/FR, Order, Status)
- Delete projects
- Toggle active/inactive status

#### Contact Submissions (`/admin/contacts`)
- View all contact submissions
- View detailed submission information
- Update submission status (New, Contacted, Completed)
- Direct WhatsApp contact link from submission details
- Delete submissions

### 3. Landing Page Integration

The landing page now dynamically pulls data from the database:
- **Services Section**: Displays all active services ordered by the 'order' field
- **Projects Section**: Displays all active projects ordered by the 'order' field
- **Contact Form**: Saves submissions to database (also opens WhatsApp)
- **Multi-language Support**: French (default) and English

### 4. Authentication System

- Secure login for admin users
- Remember me functionality
- Session-based authentication
- Admin guard separate from regular users
- Logout functionality

## How to Use

### Login to Admin Panel
1. Navigate to http://localhost:6500/admin/login
2. Enter credentials:
   - Email: admin@devvidia.com
   - Password: Devvidia@2026
3. Click "Login"

### Managing Services
1. Go to Services section from the sidebar
2. Click "Add New Service" to create a service
3. Fill in:
   - Icon (emoji like 💻)
   - Title in English and French
   - Description in English and French
   - Order (determines display position)
   - Active status (toggle on/off)
4. Click "Edit" on any service to modify it
5. Click "Delete" to remove a service

### Managing Projects
1. Go to Projects section from the sidebar
2. Click "Add New Project" to create a project
3. Fill in:
   - Icon (emoji like 📊)
   - Project Name
   - Description in English and French
   - Order (determines display position)
   - Active status (toggle on/off)
4. Click "Edit" on any project to modify it
5. Click "Delete" to remove a project

### Viewing Contact Submissions
1. Go to Contact Submissions from the sidebar
2. View list of all submissions
3. Click "View" to see full details
4. Update status as you progress (New → Contacted → Completed)
5. Click "Contact via WhatsApp" to directly message the person

## Important Notes

### WhatsApp Integration
**IMPORTANT**: You need to replace `YOUR_PHONE_NUMBER` in the following files:
1. `resources/views/landing.blade.php` (multiple instances)
2. Replace with your WhatsApp number in international format (e.g., 243XXXXXXXXX)

### Default Data
The system comes pre-populated with:
- 1 Superadmin account
- 3 Services (Web App Development, Mobile App Development, Desktop Software)
- 6 Projects (POS Event, eCommerce Platform, Driving Messenger, Startup API Kazon, cyber.blackmarket.ltd, Drivio Messenger)

### Security
- Admin authentication uses separate guard
- Passwords are hashed using Laravel's bcrypt
- Session-based authentication
- CSRF protection on all forms

## Technical Details

### Routes
- `/` - Landing page
- `/admin/login` - Admin login
- `/admin/dashboard` - Admin dashboard (protected)
- `/admin/services` - Services management (protected)
- `/admin/projects` - Projects management (protected)
- `/admin/contacts` - Contact submissions (protected)

### Models
- `App\Models\Admin` - Admin users
- `App\Models\Service` - Services
- `App\Models\Project` - Projects
- `App\Models\ContactSubmission` - Contact form submissions

### Controllers
- `App\Http\Controllers\LandingController` - Landing page and contact form
- `App\Http\Controllers\Admin\AuthController` - Admin authentication
- `App\Http\Controllers\Admin\DashboardController` - Dashboard
- `App\Http\Controllers\Admin\ServiceController` - Services CRUD
- `App\Http\Controllers\Admin\ProjectController` - Projects CRUD
- `App\Http\Controllers\Admin\ContactSubmissionController` - Contact submissions management

## Next Steps

1. **Update WhatsApp Phone Number**: Replace `YOUR_PHONE_NUMBER` in the landing page
2. **Test Admin Login**: Login with the provided credentials
3. **Customize Content**: Edit services and projects through the admin panel
4. **Monitor Submissions**: Check contact submissions regularly

## Support

All admin panel features are fully functional. You can:
- ✅ Login as superadmin
- ✅ Manage services (Create, Read, Update, Delete)
- ✅ Manage projects (Create, Read, Update, Delete)
- ✅ View and manage contact submissions
- ✅ Toggle active/inactive status for services and projects
- ✅ Change display order
- ✅ Update content in both English and French

The landing page automatically reflects all changes made in the admin panel!
