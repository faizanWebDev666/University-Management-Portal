# Session Inactivity Timeout Documentation

## Overview
This feature implements automatic session expiration after 1 minute of inactivity for faculty members in the University Management Portal. When a user becomes inactive, a warning modal appears with a 10-second countdown before automatic logout. The user can click "Stay Active" to continue their session.

## Features
- **Automatic Inactivity Detection**: Monitors user activity (mouse, keyboard, scroll, touch, click)
- **Visual Countdown**: Shows a countdown from 10-1 seconds before session expires
- **User-Friendly Modal**: Beautiful, animated warning modal with clear instructions
- **Session Persistence**: Updates last activity timestamp on every user interaction
- **Graceful Logout**: Redirects to login page with timeout message

## Implementation Details

### 1. Middleware: `SessionInactivityTimeout`
**File**: `app/Http/Middleware/SessionInactivityTimeout.php`

**Purpose**: Tracks user activity in the server-side session.

**How it works**:
- Checks if user session exists
- Retrieves last activity timestamp from session
- Compares current time with last activity time
- If inactive for more than 1 minute, flushes session and redirects
- Updates `last_activity` timestamp for every request

**Configuration**: 
- `$sessionTimeout = 1;` - Set to 1 minute for inactivity timeout

### 2. Blade Component: `inactivity-modal.blade.php`
**File**: `resources/views/components/inactivity-modal.blade.php`

**Purpose**: Displays the warning modal with countdown.

**Features**:
- Centered modal dialog
- Large countdown circle (10-1 seconds)
- Red gradient header with warning icon
- "Stay Active" button (primary action)
- "Logout" button (secondary action)
- Animated entrance and countdown effects

**Styling**:
- Gradient backgrounds
- Pulsing countdown animation
- Slide-down entrance animation

### 3. JavaScript: `inactivity-timeout.js`
**File**: `public/js/inactivity-timeout.js`

**Class**: `InactivityTimeoutManager`

**Key Methods**:
- `init()` - Initialize the manager and attach event listeners
- `startInactivityTimer()` - Start the inactivity timeout
- `attachEventListeners()` - Monitor user activity events
- `resetInactivityTimer()` - Reset timer when user is active
- `showWarningModal()` - Display the warning modal
- `startCountdown()` - Begin 10-second countdown
- `handleStayActive()` - Handle "Stay Active" button click
- `logoutDueToInactivity()` - Redirect to logout on timeout

**Configuration in initialization**:
```javascript
window.inactivityManager = new InactivityTimeoutManager({
    inactivityMinutes: 1,      // 1 minute of inactivity
    warningSeconds: 10         // Show warning for 10 seconds
});
```

**Activity Events Tracked**:
- `mousedown`
- `keydown`
- `scroll`
- `touchstart`
- `click`

### 4. Middleware Registration
**File**: `app/Http/Kernel.php`

**Added to `$routeMiddleware`**:
```php
'session.inactivity' => \App\Http\Middleware\SessionInactivityTimeout::class,
```

### 5. Route Configuration
**File**: `routes/web.php`

**Applied to Faculty Routes**:
All faculty dashboard routes are wrapped in middleware group:
```php
Route::middleware(['session.inactivity'])->group(function () {
    // All faculty routes here
});
```

**Affected Routes**:
- `faculityAdmin` - Faculty Dashboard
- `faculty/course/{uuid}` - Course Details
- `faculty/attendance` - Upload Attendance
- `WelcomeProfessor` - Welcome Page
- And 14+ other faculty routes

### 6. View Integration
**File**: `resources/views/components/faculityheader.blade.php`

**Changes**:
- Added Bootstrap Icons CDN link

**File**: `resources/views/components/faculityfooter.blade.php`

**Changes**:
- Added script reference: `js/inactivity-timeout.js`
- Added modal component include: `components.inactivity-modal`

## User Experience Flow

1. **Faculty member logs in** → Session created with `last_activity` timestamp
2. **User navigates dashboard** → Activity detected, timer resets
3. **After 50 seconds of inactivity** → Nothing visible (warning will show after 60 seconds total)
4. **After 60 seconds of inactivity** → Warning modal appears with 10-second countdown
5. **During countdown**, user can:
   - Click "Stay Active" → Modal closes, timer resets
   - Click "Logout" → Immediate logout
   - Do nothing → Auto-logout after 10 seconds
6. **After timeout** → Redirected to login page

## Configuration Options

### Change Inactivity Duration
Edit `app/Http/Middleware/SessionInactivityTimeout.php`:
```php
protected $sessionTimeout = 1; // Change to desired minutes
```

### Change Warning Duration
Edit `public/js/inactivity-timeout.js`:
```javascript
window.inactivityManager = new InactivityTimeoutManager({
    inactivityMinutes: 1,      // Total minutes before warning
    warningSeconds: 10         // Countdown duration
});
```

### Add More Activity Events
Edit `public/js/inactivity-timeout.js`:
```javascript
this.events = ['mousedown', 'keydown', 'scroll', 'touchstart', 'click', 'focus'];
```

## Customization Examples

### Change Modal Colors
In `resources/views/components/inactivity-modal.blade.php`, modify the gradient:
```blade
style="background: linear-gradient(135deg, #your-color 0%, #your-color2 100%);"
```

### Change Countdown Timer Appearance
Adjust the CSS in the same modal file:
```blade
style="width: 120px; height: 120px; ... border: 3px solid #your-color;"
```

### Add Sounds or Notifications
In `public/js/inactivity-timeout.js`, add to `showWarningModal()`:
```javascript
// Play sound
new Audio('/sounds/warning.mp3').play();
// Or show desktop notification
if (Notification.permission === 'granted') {
    new Notification('Session Timeout Warning');
}
```

## Testing

### Manual Testing Steps
1. Login as faculty member
2. Navigate to faculty dashboard
3. Do NOT perform any actions for 1 minute
4. Verify warning modal appears
5. Watch countdown from 10 to 1
6. Test "Stay Active" button - should close modal and reset timer
7. Test "Logout" button - should immediately logout
8. Let countdown expire - should automatically logout

### Browser Console Debugging
The implementation includes console logging. Open DevTools (F12) to see:
```
[Inactivity Manager] Initialized with 1 minute(s) timeout
[Inactivity Manager] Activity detected, resetting timer
[Inactivity Manager] Showing warning modal
[Inactivity Manager] Countdown: 10 seconds remaining
```

## Troubleshooting

### Modal not appearing
- Verify Bootstrap JS is loaded before the inactivity script
- Check browser console for errors
- Ensure modal component is included in footer

### Countdown not working
- Check if JavaScript console shows initialization message
- Verify `inactivity-timeout.js` is loaded (check Network tab)
- Confirm Bootstrap Modal is available

### Session not expiring
- Verify middleware is registered in Kernel.php
- Check that faculty routes have `session.inactivity` middleware
- Verify logout route exists and works correctly

### User activity not detected
- Check if activity events are properly attached
- Verify event listeners aren't conflicting with other scripts
- Test with different activities (mouse, keyboard, touch)

## Browser Compatibility
- Chrome/Edge: ✅ Full support
- Firefox: ✅ Full support
- Safari: ✅ Full support
- IE 11: ⚠️ Requires polyfills for Bootstrap 5

## Performance Considerations
- **Minimal overhead**: Only one timer per user session
- **No database hits**: Uses session storage only
- **Efficient event handling**: Debounced by timer reset
- **Lightweight**: JS file is ~6KB

## Security Notes
- Session data is stored server-side (secure)
- Middleware validates on every request
- Modal prevents accidental navigation during timeout
- CSRF token still required for form submissions

## Future Enhancements
- Add database logging of timeout events
- Implement activity-based points/rewards system
- Add admin settings to customize timeout duration
- Implement persistent activity log
- Add export of user activity reports

## Support
For issues or questions about this implementation:
1. Check the Troubleshooting section
2. Review console logs for error messages
3. Verify all files are in correct locations
4. Test with a simple faculty account first
