# Student Management System (Sistem Manajemen Data Santri)

## Overview
A comprehensive CRUD (Create, Read, Update, Delete) system for managing student data in the Yayasan Al-Khoir website. Built with Laravel backend and modern JavaScript frontend using Tailwind CSS.

## Features

### 🎯 Core Functionality
- **Complete CRUD Operations**: Create, read, update, and delete student records
- **Advanced Search & Filtering**: Search by name, NIS, or class with real-time filtering
- **Status Management**: Track student status (Active, Inactive, Graduated, Transferred)
- **Program Assignment**: Associate students with educational programs
- **Photo Management**: Upload and manage student photos with preview
- **Bulk Operations**: Select and delete multiple students at once

### 🎨 User Interface
- **Modern Design**: Clean, responsive interface using Tailwind CSS
- **Responsive Layout**: Optimized for desktop, tablet, and mobile devices
- **Interactive Elements**: Smooth animations, hover effects, and transitions
- **Modal Forms**: Clean add/edit forms with validation feedback
- **Toast Notifications**: Success/error messages with auto-dismiss
- **Loading States**: Visual feedback during data operations

### 🔍 Advanced Features
- **Real-time Search**: Debounced search with instant results
- **Smart Pagination**: Efficient pagination with page navigation
- **Data Validation**: Comprehensive form validation with error display
- **File Upload**: Image upload with size and format validation
- **Status Badges**: Color-coded status indicators
- **Bulk Selection**: Checkbox-based multi-selection system

## Technical Implementation

### Backend (Laravel)
- **Controller**: `SantriController` with RESTful API endpoints
- **Model**: `Student` model with relationships and accessors
- **Validation**: `StudentRequest` with comprehensive validation rules
- **File Storage**: Laravel Storage for photo management
- **Soft Deletes**: Safe deletion with data recovery capability

### Frontend (JavaScript)
- **Class-based Architecture**: `StudentManager` class for organized code
- **Event-driven**: Responsive to user interactions
- **Async Operations**: Modern async/await pattern for API calls
- **Error Handling**: Comprehensive error handling and user feedback
- **Performance**: Debounced search and efficient DOM manipulation

### Database Schema
```sql
students table:
- id (Primary Key)
- nis (Student ID Number)
- nama_lengkap (Full Name)
- nama_panggilan (Nickname)
- tempat_lahir (Birth Place)
- tanggal_lahir (Birth Date)
- jenis_kelamin (Gender: L/P)
- agama (Religion)
- alamat (Address)
- nama_ortu (Parent Name)
- telepon_ortu (Parent Phone)
- email_ortu (Parent Email)
- program_id (Program Reference)
- kelas (Class)
- status (Status: aktif/nonaktif/lulus/pindah)
- tanggal_masuk (Enrollment Date)
- foto (Photo Path)
- catatan (Notes)
- created_at, updated_at, deleted_at (Timestamps)
```

## Installation & Setup

### Prerequisites
- Laravel 10+ with PHP 8.1+
- MySQL/PostgreSQL database
- Composer for dependency management
- Node.js for frontend assets (optional)

### Setup Steps
1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd WEBSITE_YAYASAN_ALKHOIR
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   # Configure database and storage settings
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Storage setup**
   ```bash
   php artisan storage:link
   ```

6. **Start the application**
   ```bash
   php artisan serve
   ```

## Usage

### Accessing the System
Navigate to: `/admin/management/data-santri/content`

### Adding a New Student
1. Click "Tambah Santri" button
2. Fill in required fields (marked with *)
3. Upload student photo (optional)
4. Click "Simpan" to save

### Editing Student Data
1. Click the edit icon (pencil) on any student row
2. Modify the information as needed
3. Click "Update" to save changes

### Deleting Students
1. **Single Delete**: Click the delete icon (trash) on any student row
2. **Bulk Delete**: Select multiple students using checkboxes and click "Hapus Terpilih"

### Searching & Filtering
- **Search**: Use the search box to find students by name, NIS, or class
- **Status Filter**: Filter by student status (Active, Inactive, etc.)
- **Program Filter**: Filter by educational program
- **Reset**: Click "Reset Filter" to clear all filters

## API Endpoints

### Student Management
```
GET    /admin/students          - List students with pagination
POST   /admin/students          - Create new student
GET    /admin/students/{id}     - Get student details
PUT    /admin/students/{id}     - Update student
DELETE /admin/students/{id}     - Delete student
PATCH  /admin/students/{id}/status - Update student status
DELETE /admin/students/bulk     - Bulk delete students
```

### Response Format
```json
{
    "success": true,
    "message": "Operation message",
    "data": {
        // Student data or pagination info
    }
}
```

## Customization

### Adding New Fields
1. Update the database migration
2. Modify the `Student` model
3. Update the `StudentRequest` validation rules
4. Add form fields in the Blade template
5. Update the JavaScript form handling

### Modifying Status Options
Edit the status options in:
- `StudentRequest.php` validation rules
- `Student.php` model accessor
- `santri_account.js` status display methods
- Blade template status filter

### Changing Photo Storage
Modify the storage configuration in:
- `SantriController.php` file upload methods
- `.env` file storage settings
- `config/filesystems.php` storage configuration

## Security Features

- **Authentication**: Protected by Laravel auth middleware
- **CSRF Protection**: Built-in CSRF token validation
- **Input Validation**: Comprehensive server-side validation
- **File Upload Security**: File type and size validation
- **SQL Injection Protection**: Eloquent ORM with parameter binding

## Performance Optimizations

- **Lazy Loading**: Relationships loaded only when needed
- **Pagination**: Efficient data loading with pagination
- **Debounced Search**: Reduced API calls during typing
- **Image Optimization**: Proper image storage and delivery
- **Caching**: Laravel's built-in caching mechanisms

## Browser Support

- **Modern Browsers**: Chrome 90+, Firefox 88+, Safari 14+, Edge 90+
- **Mobile**: iOS Safari 14+, Chrome Mobile 90+
- **JavaScript**: ES6+ with async/await support

## Troubleshooting

### Common Issues

1. **Photos not displaying**
   - Check storage link: `php artisan storage:link`
   - Verify file permissions on storage directory
   - Check photo path in database

2. **Validation errors not showing**
   - Ensure CSRF token is included in forms
   - Check browser console for JavaScript errors
   - Verify validation rules in `StudentRequest`

3. **Search not working**
   - Check database indexes on searchable fields
   - Verify search query in controller
   - Check JavaScript console for errors

4. **Bulk operations failing**
   - Ensure proper CSRF token handling
   - Check selected students count
   - Verify bulk delete endpoint

### Debug Mode
Enable debug mode in `.env`:
```env
APP_DEBUG=true
APP_ENV=local
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is part of the Yayasan Al-Khoir website system.

## Support

For technical support or questions:
- Check the Laravel documentation
- Review the code comments
- Check the browser console for errors
- Verify database connectivity and permissions

---

**Last Updated**: January 2025
**Version**: 1.0.0
**Developer**: AI Assistant
