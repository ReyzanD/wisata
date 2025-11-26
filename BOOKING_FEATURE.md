# Booking Feature Documentation

## Overview
A complete booking system has been implemented for the Wisata Indonesia tourism application, allowing users to book visits to destinations.

## Features Implemented

### 1. Database Schema
- **Table**: `bookings_232136`
- **Fields**:
  - `id`: Primary key
  - `user_id_232136`: Foreign key to users table
  - `destination_id_232136`: Foreign key to destinations table
  - `booking_code_232136`: Unique booking reference code (format: BK + 8 characters)
  - `visit_date_232136`: Date of planned visit
  - `number_of_people_232136`: Number of people (1-50)
  - `special_requests_232136`: Optional special requests/notes
  - `status_232136`: Enum (pending, confirmed, cancelled)
  - `total_price_232136`: Optional price field for future use
  - `created_at`, `updated_at`: Timestamps

### 2. Models
- **Booking Model** (`app/Models/Booking.php`)
  - Relationships: `user()`, `destination()`
  - Helper methods: 
    - `generateBookingCode()`: Generates unique booking codes
    - `getStatusBadgeClass()`: Returns CSS classes for status badges
    - `getStatusText()`: Returns localized status text
  - Updated User and Destination models with `bookings()` relationship

### 3. Routes
**Public Routes (Authenticated):**
- `GET /bookings` - List user's bookings
- `GET /bookings/create/{destination}` - Booking form
- `POST /bookings/{destination}` - Submit booking
- `GET /bookings/{id}` - View booking details
- `POST /bookings/{id}/cancel` - Cancel pending booking

**Admin Routes:**
- `GET /admin/bookings` - Manage all bookings
- `POST /admin/bookings/{id}/status` - Update booking status

### 4. Controllers
**BookingController** (`app/Http/Controllers/BookingController.php`)
- `index()`: User's booking list
- `create()`: Display booking form
- `store()`: Create new booking with validation
- `show()`: Booking details/confirmation
- `cancel()`: Cancel pending booking
- `adminIndex()`: Admin booking management
- `updateStatus()`: Admin status updates

### 5. Views

**User Views:**
- `resources/views/bookings/create.blade.php`
  - Booking form with destination preview
  - Date picker (restricts past dates)
  - Number of people selector (1-50)
  - Special requests textarea
  - Terms & conditions

- `resources/views/bookings/index.blade.php`
  - List of user's bookings
  - Status badges (pending/confirmed/cancelled)
  - Quick actions (view, cancel)
  - Empty state with call-to-action

- `resources/views/bookings/show.blade.php`
  - Booking confirmation page
  - Displays booking code prominently
  - Shows all booking details
  - Destination information
  - Important instructions
  - Cancel option for pending bookings

**Admin View:**
- `resources/views/admin/bookings/index.blade.php`
  - Table view of all bookings
  - User and destination details
  - Status management dropdown
  - View special requests
  - Statistics cards (pending/confirmed/cancelled counts)

### 6. UI Integration

**Destination Detail Page:**
- Added prominent booking card in sidebar
- "Pesan Sekarang" (Book Now) button for authenticated users
- "Login untuk Booking" for guests
- Rating and location display
- Link to view user's bookings

**Navigation:**
- Added "Booking Saya" link in public navigation (authenticated users)
- Added "Booking" link in admin navigation (desktop & mobile)

### 7. Validation Rules
- `visit_date_232136`: Required, must be date, cannot be in the past
- `number_of_people_232136`: Required, integer, between 1-50
- `special_requests_232136`: Optional, max 1000 characters
- Custom error messages in Indonesian

### 8. Status Flow
1. **Pending**: Initial status when booking is created
2. **Confirmed**: Admin approves the booking
3. **Cancelled**: User cancels (only while pending) or admin cancels

### 9. Business Logic
- Unique booking codes automatically generated
- Users can only cancel pending bookings
- Confirmed bookings cannot be cancelled by users
- Admin can change any booking status
- Bookings are tied to authenticated users

## Migration Instructions

To apply the database changes:

```bash
php artisan migrate
```

This will create the `bookings_232136` table with all necessary fields and foreign key constraints.

## Usage Flow

### For Users:
1. Browse destinations on the public site
2. Click on a destination to view details
3. Click "Pesan Sekarang" button in the sidebar
4. Fill in the booking form (date, number of people, special requests)
5. Submit booking
6. Receive booking confirmation with unique code
7. View booking status in "Booking Saya" page
8. Can cancel pending bookings

### For Admins:
1. Access admin panel
2. Navigate to "Booking" section
3. View all bookings in table format
4. Click "Ubah Status" to change booking status
5. View special requests by clicking the eye icon
6. Monitor statistics (pending/confirmed/cancelled)

## Future Enhancements
- Email notifications for status changes
- Payment integration using `total_price_232136` field
- Calendar view for admin
- Booking history and analytics
- PDF ticket generation
- QR code for booking verification
- Booking reminder notifications
- Review prompt after visit date

## Technical Notes
- Uses Alpine.js for interactive UI elements
- Follows Laravel naming conventions with `_232136` suffix
- Implements proper authorization (users can only view their own bookings)
- Admin-only status management
- Responsive design for mobile and desktop
- Toast notifications for user feedback
