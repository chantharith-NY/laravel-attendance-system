# Student Attendance System — System Flow Documentation

## 1. Overview
A Laravel-based system for managing students, classes, teachers, and attendance records. Includes admin, teacher, and student roles with secure authentication.
---
## 2. System Architecture
### 2.1 MVC Components

- Models: User, Student, Teacher, Class, Attendance

- Controllers: AdminController, ClassController, StudentController, AttendanceController, etc.

- Views: Blade templates for dashboards and CRUD pages

- Routes: Web + API
---
## 3. High-Level System Flow
### 3.1 Authentication Flow
```
User visits login page
        ↓
User submits email + password
        ↓
Laravel Auth checks credentials
        ↓
Redirect based on role:
    - Admin → Admin Dashboard
    - Teacher → Teacher Dashboard
    - Student → Student Attendance Profile
```
---
### 3.2 Admin System Flow

**Admin tasks**

- Manage Teachers

- Manage Students

- Manage Classes

- Assign teachers to classes

````
Admin login
   ↓
Admin Dashboard
   ↓
Select Module:
   - Student Management
   - Teacher Management
   - Class Management
   ↓
CRUD operations
   ↓
Database updated using Models + Migrations
````
---
### 3.3 Teacher Attendance Flow
```
Teacher login
   ↓
Teacher Dashboard
   ↓
Select Class
   ↓
System loads class students (WHERE class_id = X)
   ↓
Teacher marks:
   - Present
   - Absent
   - Late
   ↓
Submit attendance
   ↓
Records saved in attendance table
```
---
### 3.4 Student Flow
```
Student login
   ↓
Student Dashboard
   ↓
View personal information
   ↓
View attendance records (filtered by student_id)
   ↓
View attendance percentage
```
---
## 4. Database Interaction Flow
**When teacher selects a class:**
```
ClassController → Class Model → students table → return list
```
**When marking attendance:**
```
AttendanceController
   ↓ validate request
   ↓ save multiple attendance rows
   ↓ return success response
```
**When admin creates a student:**
```
AdminController → create user → create student → link class
```
---
## 5. Security Flow
**5.1 Authentication Middleware**
```
auth → ensures login required
```
**5.2 Role Middleware**
```
role:admin → admin-only pages  
role:teacher → teacher-only pages  
role:student → student-only pages
```
**5.3 CSRF Protection**

Laravel automatically protects POST/PUT/PATCH/DELETE requests.

---

# Full User Flow

## Admin User Flow
```
Login → Admin Dashboard
     ↓
View total students, teachers, classes
     ↓
Manage:
   - Students
       - Add Student
       - Edit Student
       - Delete Student
   - Teachers
       - Add Teacher
       - Assign Class
   - Classes
       - Add Class
       - Assign Teacher
```
Admin can:

- Create user accounts

- Assign roles

- Control all system data

---

## Teacher User Flow
```
Login → Teacher Dashboard
     ↓
View assigned classes
     ↓
Select a class
     ↓
View student list
     ↓
Mark attendance (present/absent/late)
     ↓
Submit attendance
     ↓
View attendance summary for classes
```
Teacher cannot:

- Modify students outside their classes

- Access admin pages

---
## Student User Flow
```
Login → Student Dashboard
     ↓
View personal profile
     ↓
View attendance history
     ↓
See attendance percentage
```
Students can only:

- See their own attendance

- Update profile (optional)
---
