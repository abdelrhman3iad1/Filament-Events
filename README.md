# ⚡ Filament Event-Driven Dashboard

## 📘 Overview
This project is a **Filament SPA Dashboard** built with **Laravel**, using an **event-driven architecture** to handle post creation, email notifications, and real-time broadcasts.  
The goal is to make the system **asynchronous, real-time, and scalable** using Laravel tools like **Octane**, **Horizon**, **Reverb**, and **Redis** as a **queue driver** for background job processing.

---

## ⚙️ How It Works

### 📝 Post Creation in Filament Dashboard
When a new post is created, Filament’s `afterCreate` hook triggers the **PostCreated** event.

### 🔔 Event Trigger
The **PostCreated** event fires two listeners:
- **SendPostEmails** → sends emails to all users.  
- **SendPostNotification** → sends a broadcast notification to connected users.

### ✉️ Notifications System
- **Emails:** Sent through Laravel’s Notification system on a dedicated `emails` queue.  
- **Broadcasts:** Sent in real time using **Laravel Reverb** and received in the Filament dashboard via **Laravel Echo**.  
- Both notification jobs are pushed into **Redis queues**, ensuring they are processed asynchronously and efficiently.

### ⚡ Real-Time Dashboard Updates
The Filament SPA listens to the `posts` channel.  
When a new post is broadcasted, all users instantly get a Filament notification with the post details — **no page reload needed**.

---

# 🔄 System Flow (Lifecycle Explanation)

## 📝 Post Creation through Filament Dashboard
- The user creates a new post within the **Filament SPA dashboard**.
- Once the post is successfully stored in the database, Filament’s **`afterCreate` hook** executes.

## 🚀 Event Firing (PostCreated)
- This hook dispatches the **`PostCreated` event**, carrying the post’s data.
- This event is the backbone of the event-driven flow, ensuring that subsequent actions are executed **asynchronously**.

## ⚙️ Listeners Execution
The system has two dedicated listeners that respond to this event:

### 1. 📨 SendPostEmails
- Responsible for sending **email notifications** to all registered users.
- Runs on a **separate queue** named `emails` managed by **Redis**, ensuring smooth, non-blocking background processing.
- Efficiently handles large user datasets by processing users in **chunks** to avoid memory overload.

### 2. 🔔 SendPostNotification
- Responsible for sending **real-time broadcast notifications** using Laravel’s broadcasting system.
- Runs on another **dedicated queue** named `notifications`, also managed by **Redis**, keeping workloads isolated and efficient.

## ✉️ Notification Dispatching
- The **email listener** uses Laravel’s **Notification system** to send custom mail templates that include post content and author information.
- The **broadcast listener** uses **WebSockets via Laravel Reverb** to deliver real-time notifications to connected dashboard users.
- Both notifications are queued and executed asynchronously through **Redis workers** managed and monitored by **Laravel Horizon**.

## ⚡ Real-time Dashboard Update
- The **Filament dashboard** acts as a live SPA connected to the **Reverb WebSocket server** using **Laravel Echo**.
- When a `post-created` event is broadcasted, the dashboard immediately receives it **without refreshing the page**.
- A **dynamic in-app Filament notification** appears to all users, showing the new post’s **title, author, and content**.

---

## 🧩 Main Tools Used
- **Filament Dashboard** → Admin SPA with real-time notifications  
- **Laravel Events & Listeners** → Core of the event-driven architecture  
- **Laravel Notifications** → Sends both mail and broadcast messages  
- **Laravel Horizon** → Manages and monitors queues for jobs and notifications  
- **Laravel Octane (OpenSwoole)** → Improves performance and concurrency  
- **Laravel Reverb** → Handles WebSocket broadcasting for real-time features  
- **Laravel Echo** → Connects the Filament SPA to Reverb for live updates  
- **Redis** → Acts as the **primary queue driver** for asynchronous job handling  

---

## 🧱 Architecture Summary
**Event:** `PostCreated`  
**Listeners:**
- `SendPostEmails` → queue: `emails` (Redis)  
- `SendPostNotification` → queue: `notifications` (Redis)  

**Queues:** Managed with **Redis** and monitored via **Laravel Horizon**  
**Real-Time Updates:** Powered by **Reverb + Echo connection**  
**Dashboard:** Filament SPA with live notification rendering  

---

## 🚀 Key Features
✅ Event-driven design for clean and scalable logic  
✅ Asynchronous email and broadcast processing via **Redis queues**  
✅ Real-time UI updates without page refresh  
✅ High performance with **Laravel Octane**  
✅ Queue management and monitoring using **Laravel Horizon**  
✅ Scalable and fault-tolerant background job handling through **Redis**  

---

## 📚 References
- [Laravel Events](https://laravel.com/docs/events)
- [Laravel Notifications](https://laravel.com/docs/notifications)
- [Laravel Horizon](https://laravel.com/docs/horizon)
- [Laravel Octane](https://laravel.com/docs/octane)
- [Laravel Reverb](https://laravel.com/docs/reverb)
- [Laravel Queues & Redis](https://laravel.com/docs/queues#redis)
- [Filament Documentation](https://filamentphp.com/docs)
