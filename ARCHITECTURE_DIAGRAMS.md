# Session Inactivity Timeout - Architecture & Flow Diagrams

## System Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                     FACULTY DASHBOARD                          │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │              Browser (Client-Side)                      │  │
│  ├──────────────────────────────────────────────────────────┤  │
│  │                                                          │  │
│  │  1. inactivity-timeout.js                               │  │
│  │     ├─ Monitors user activity                           │  │
│  │     ├─ Detects: mouse, keyboard, scroll, touch, click   │  │
│  │     ├─ Starts inactivity timer                          │  │
│  │     └─ Shows modal on timeout                           │  │
│  │                                                          │  │
│  │  2. inactivity-modal.blade.php                          │  │
│  │     ├─ Warning modal HTML                               │  │
│  │     ├─ Countdown display (10-1 seconds)                 │  │
│  │     ├─ Stay Active button                               │  │
│  │     └─ Logout button                                    │  │
│  │                                                          │  │
│  └──────────────────────────────────────────────────────────┘  │
│                          ↑                                       │
│                          │ HTTP Requests                         │
│                          ↓                                       │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │              Server (Backend - Laravel)                 │  │
│  ├──────────────────────────────────────────────────────────┤  │
│  │                                                          │  │
│  │  1. SessionInactivityTimeout Middleware                 │  │
│  │     ├─ Intercepts every request                         │  │
│  │     ├─ Checks last_activity timestamp                   │  │
│  │     ├─ Compares with current time                       │  │
│  │     └─ Expires session if inactive > 1 min              │  │
│  │                                                          │  │
│  │  2. Kernel.php                                          │  │
│  │     └─ Registers 'session.inactivity' middleware        │  │
│  │                                                          │  │
│  │  3. web.php Routes                                      │  │
│  │     └─ Applies middleware to faculty routes             │  │
│  │                                                          │  │
│  │  4. Session Storage                                     │  │
│  │     └─ Stores last_activity timestamp                   │  │
│  │                                                          │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

## Request Flow Diagram

```
Faculty Member visits page
         ↓
┌────────────────────────────────────┐
│ Browser sends HTTP request         │
└────────────────────────────────────┘
         ↓
┌────────────────────────────────────┐
│ Laravel Middleware Stack           │
│ ├─ StartSession                    │
│ ├─ VerifyCsrfToken                 │
│ ├─ SessionInactivityTimeout ◄─────┐│ ← Checks inactivity
│ └─ Other middleware                ││
└────────────────────────────────────┘│
         ↓                            │
┌────────────────────────────────────┐│
│ Inactivity Check:                   ││
│                                     ││
│ ├─ Get last_activity from session  ││
│ ├─ Calculate time since activity   ││
│ ├─ Is inactive > 1 minute?         ││
│ │   ├─ YES → Flush session ────────┼┤
│ │   │   └─ Redirect to /login      ││
│ │   └─ NO → Continue ──────────────┼┤
│ │                                   ││
│ └─ Update last_activity timestamp  ││
└────────────────────────────────────┘│
         ↓                            │
┌────────────────────────────────────┐│
│ Route Handler (Controller)          ││
│ └─ Execute action                  ││
└────────────────────────────────────┘│
         ↓                            │
┌────────────────────────────────────┐│
│ Return Response                     ││
│ ├─ HTML                            ││
│ ├─ JS (inactivity-timeout.js)      ││
│ └─ Modal (inactivity-modal)        ││
└────────────────────────────────────┘
         ↓
┌────────────────────────────────────┐
│ Browser receives response           │
│ └─ JS initializes timer             │
└────────────────────────────────────┘
```

## Inactivity Detection Flow

```
Page Loads
    │
    ↓
┌─────────────────────────────────┐
│ JS: Initialize Manager          │
│ • Start 1-minute timer          │
│ • Attach event listeners        │
│ • Modal not shown yet           │
└─────────────────────────────────┘
    │
    ├─ Activity Detected (click, type, etc)
    │   ↓
    │  ┌─────────────────────────────┐
    │  │ Reset Timer                 │
    │  │ • Clear current timeout     │
    │  │ • Start new 1-minute timer  │
    │  │ • Modal stays hidden        │
    │  └─────────────────────────────┘
    │   ↑
    │   └────── (Timer resets every activity)
    │
    └─ No Activity for 1 minute
        ↓
    ┌─────────────────────────────┐
    │ Show Warning Modal          │
    │ • Display: "Expiring in..." │
    │ • Modal prevents closing    │
    └─────────────────────────────┘
        ↓
    ┌─────────────────────────────┐
    │ Start 10-Second Countdown   │
    │ • Display: 10, 9, 8, 7...   │
    │ • Update every 1 second     │
    │ • Pulsing animation         │
    └─────────────────────────────┘
        ↓
    ┌─────────────────────────────┐
    │ User Choice?                │
    ├─────────────────────────────┤
    │                             │
    ├─→ Click "Stay Active"       │
    │   ├─ Close modal            │
    │   ├─ Reset timer to 1 min   │
    │   └─ Go back to start       │
    │                             │
    ├─→ Click "Logout"            │
    │   └─ Redirect to /logout    │
    │                             │
    └─→ Do nothing (wait)         │
        ├─ Countdown reaches 0    │
        ├─ Redirect to /logout    │
        └─ Auto-logout triggered  │
```

## State Diagram

```
┌────────────────┐
│   LOGGED IN    │
│                │
│ Session Active │
└────────────────┘
        │
        ↓
    ┌─────────────────────┐
    │ ACTIVE STATE        │
    │                     │
    │ Timer: 1 min        │
    │ Activity detected   │
    │ Timer resets        │
    └─────────────────────┘
        │
        │ (No activity for 1 min)
        ↓
    ┌─────────────────────┐
    │ WARNING STATE       │
    │                     │
    │ Modal appears       │
    │ Countdown: 10 sec   │
    │ Timer decrements    │
    └─────────────────────┘
        │
        ├─ Stay Active ──→ Back to ACTIVE STATE
        │
        ├─ Logout ───────→ LOGGED OUT
        │
        └─ No action ───→ LOGGED OUT
            (10 seconds)
```

## Component Interaction Diagram

```
┌────────────────────────────────────────────────────────────┐
│                   REQUEST LIFECYCLE                        │
├────────────────────────────────────────────────────────────┤
│                                                            │
│  1. Request comes in                                       │
│     └─→ SessionInactivityTimeout Middleware activates      │
│         ├─ Retrieves last_activity from session            │
│         ├─ Checks: now - last_activity > 1 minute?         │
│         └─ If YES: Flush session → Redirect to login       │
│           If NO: Update last_activity → Continue request   │
│                                                            │
│  2. Response sent to browser                               │
│     └─→ Contains:                                           │
│         ├─ HTML page                                       │
│         ├─ inactivity-timeout.js                           │
│         └─ inactivity-modal.blade.php                      │
│                                                            │
│  3. Browser receives response                              │
│     └─→ inactivity-timeout.js initializes                  │
│         ├─ Creates InactivityTimeoutManager                │
│         ├─ Starts 1-minute countdown                       │
│         ├─ Attaches event listeners                        │
│         └─ Ready to detect activity                        │
│                                                            │
│  4. User interacts with page                               │
│     └─→ Events triggered:                                  │
│         ├─ mousedown                                       │
│         ├─ keydown                                         │
│         ├─ scroll                                          │
│         ├─ touchstart                                      │
│         └─ click                                           │
│         └─→ Timer reset!                                   │
│                                                            │
│  5. No activity for 1 minute                               │
│     └─→ Modal shows with countdown                         │
│         ├─ 10, 9, 8, 7, 6, 5, 4, 3, 2, 1                  │
│         └─ Awaiting user action                            │
│                                                            │
│  6. Countdown ends                                          │
│     └─→ Auto-logout to /logout                             │
│                                                            │
└────────────────────────────────────────────────────────────┘
```

## File Dependency Diagram

```
routes/web.php (Faculty Routes)
        │
        ├──→ SessionInactivityTimeout Middleware
        │    └──→ app/Http/Kernel.php (Registration)
        │
        └──→ Faculty Controller
             └──→ faculity_dashboard/index.blade.php
                  │
                  ├──→ faculityheader.blade.php
                  │    ├─ Bootstrap Icons CDN
                  │    └─ Links & styles
                  │
                  ├──→ Content (Main Area)
                  │
                  └──→ faculityfooter.blade.php
                       ├─ Bootstrap JS
                       ├─ public/js/inactivity-timeout.js
                       └─ components/inactivity-modal.blade.php
                          ├─ Modal HTML
                          └─ Modal styles & animations
```

## Session Timeline with Annotations

```
TIME    BACKEND (Server)              CLIENT (Browser)           USER ACTION
────────────────────────────────────────────────────────────────────────────

0:00    Session created              Page loads                 Logs in
        last_activity = now          JS initializes
                                    Modal hidden
                                    Timer: 60 sec

0:15    ← Request →                  Detects activity          Clicks button
        last_activity updated        Timer resets: 60 sec

0:30    ← Request →                  Detects activity          Types text
        last_activity updated        Timer resets: 60 sec

0:50    (No request)                 Waiting...                Stops interacting
                                    Timer: 10 sec remaining

1:00    (No request)                 ⚠️ WARNING MODAL           Sees warning
                                    Timer: 10, 9, 8, 7...
                                    Countdown active

1:05    (No request)                 Still warning             Considering...
                                    Timer: 5, 4, 3...

1:08    ← Request →                  Timer resets: 60 sec      Clicks "Stay Active"
        last_activity updated        Modal closes              
                                    Back to normal

1:30    ← Request →                  Detects activity          Uses dashboard
        last_activity updated        Timer resets: 60 sec

2:30    (No activity)                Warning modal             Ignores warning
                                    Timer: 1, 0 seconds

2:31    Session flushed              Redirect to /login        Auto-logout
        Redirect to /login           Page shows login form
```

## Security Layers

```
┌─────────────────────────────────────────────────────────────┐
│                    SECURITY LAYERS                          │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  Layer 1: Server-Side Session Validation                   │
│  ├─ Middleware checks on EVERY request                      │
│  ├─ Session data is server-stored (not client editable)    │
│  ├─ last_activity timestamp validated                      │
│  └─ Cannot bypass by disabling JavaScript                  │
│                                                             │
│  Layer 2: Client-Side User Experience                      │
│  ├─ Provides visual warning before timeout                 │
│  ├─ Allows user to stay active                             │
│  ├─ Shows countdown for transparency                       │
│  └─ Prevents accidental navigation loss                    │
│                                                             │
│  Layer 3: Session Termination                              │
│  ├─ Session fully flushed on timeout                       │
│  ├─ All session data cleared                               │
│  ├─ User redirected to fresh login                         │
│  └─ No residual authentication data                        │
│                                                             │
│  Layer 4: CSRF Protection                                   │
│  ├─ CSRF tokens still validated                            │
│  ├─ Protected forms unaffected                             │
│  ├─ Cross-site attacks still prevented                     │
│  └─ Security policies maintained                           │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

---

**Legend:**
- `→` = Data flow
- `│` = Connection
- `├` = Branch
- `↓` = Sequential flow
- `◄` = Points to relevant component
