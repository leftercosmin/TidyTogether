# TidyTogether - Software Requirements Specification
Prepared by Braha Petru and Lefter Cosmin,
2E3, Computer Science, FII, Iasi,
on 01.07.2025

Table of Contents
=================
  * [Revision History](#revision-history)
  * [Introduction](#1-introduction)
    * 1.1 [Purpose](#11-purpose)
    * 1.2 [Document Conventions](#12-document-conventions)
    * 1.3 [Intended Audience and Reading Suggestions](#13-intended-audience-and-reading-suggestions)
    * 1.4 [Product Scope](#14-product-scope)
    * 1.5 [References](#15-references)
  * [Overall Description](#overall-description)
    * 2.1 [Product Perspective](#21-product-perspective)
    * 2.2 [Product Functions](#22-product-functions)
    * 2.3 [User Classes and Characteristics](#23-user-classes-and-characteristics)
    * 2.4 [Operating Environment](#24-operating-environment)
    * 2.5 [Design and Implementation Constraints](#25-design-and-implementation-constraints)
    * 2.6 [User Documentation](#26-user-documentation)
    * 2.7 [Assumptions and Dependencies](#27-assumptions-and-dependencies)
  * [External Interface Requirements](#external-interface-requirements)
    * 3.1 [User Interfaces](#31-user-interfaces)
    * 3.2 [Hardware Interfaces](#32-hardware-interfaces)
    * 3.3 [Software Interfaces](#33-software-interfaces)
    * 3.4 [Communications Interfaces](#34-communications-interfaces)
  * [System Features](#system-features)
    * 4.1 [System Feature 1](#41-system-feature-1)
    * 4.2 [System Feature 2](#42-system-feature-2-and-so-on)
    * 4.3 [System Feature 3](#43-system-feature-2-and-so-on)
  * [Other Nonfunctional Requirements](#other-nonfunctional-requirements)
    * 5.1 [Performance Requirements](#51-performance-requirements)
    * 5.2 [Safety Requirements](#52-safety-requirements)
    * 5.3 [Security Requirements](#53-security-requirements)
    * 5.4 [Software Quality Attributes](#54-software-quality-attributes)
    * 5.5 [Business Rules](#55-business-rules)
  * [Other Requirements](#other-requirements)
* [Appendix A: Glossary](#appendix-a-glossary)
* [Appendix B: Analysis Models](#appendix-b-analysis-models)
* [Appendix C: To Be Determined List](#appendix-c-to-be-determined-list)




## Revision History
| Name | Date    | Reason For Changes  | Version   |
| ---- | ------- | ------------------- | --------- |
| init | 01.07.2025 | concrete documentation | 0.1 |
|      |         |                     |           |
|      |         |                     |           |

## 1. Introduction
### 1.1 Purpose 

This document defines the software requirements for the TidyTogether application—a platform designed to support the identification, localization, and management of recycling sites. The system involves three primary user roles: civilians, supervisors, and local authorities. The application enables civilians to locate and report areas with accumulated waste, which are then reviewed and validated by supervisors before being forwarded to the appropriate local authorities for action. This collaborative process aims to facilitate timely clean-up efforts and promote environmental responsibility.

This Software Requirements Specification (SRS) refers to version 1.0 of the system and covers the complete functionality of the application, without excluding any components or subsystems.

### 1.2 Document Conventions

Requirements are numbered in (Section)(Number) format (e.g. 4.1.3.1).

The important terms are `indented`.

`TBD` indicates requirements or information to be defined later.

### 1.3 Intended Audience and Reading Suggestions

This document is intended for a diverse audience involved in the development, use, or evaluation of the TidyTogether application. Depending on the reader’s role and purpose, different sections of the document may be of particular relevance.

Before delving into the technical specifications, it is recommended that readers first consult the [README](./../README.md) document for a high-level overview. Additional user-facing information may also be found in the [User Documentation](#26-user-documentation), which provides practical guidance and usage details.

Recommended reading paths by role:
- End Users (Civilians, Supervisors, Authorities): Sections 2.3 (User Classes) and 4 (System Features)
- Developers: Sections 4 (System Features) and 5 (Nonfunctional Requirements)
- Project Managers: Sections 1 (Introduction), 2 (Overall Description), and 5 (Nonfunctional Requirements)
- Testers: Sections 3 (External Interface Requirements) and 4 (System Features)
- Local Authorities: Section 2 (Overall Description)
- Academic Reviewers (e.g., Professors): All sections
- IT Companies & Marketing Staff: Sections 2.3 (User Classes) and 4 (System Features)

### 1.4 Product Scope

TidyTogether is a collaborative platform designed to streamline the management and awareness of recycling sites within urban areas. The system facilitates cooperation between three main user groups:

- Authorities are responsible for publishing verified recycling locations.
- Civilians can view these locations and report additional areas with significant waste accumulation.
- Supervisors review and validate civilian reports before forwarding them to the appropriate authorities.

Through this coordinated workflow, the platform enables civilians to assist local authorities in identifying neglected or polluted areas. Our project also provides transparent data regarding the status and progress of clean-up efforts across the city.

Key Benefits:
- Improved environmental conditions (e.g., better air quality and cleaner public spaces)
- Promotion of eco-conscious behavior and community engagement
- A more pleasant and livable urban atmosphere
- Long-term environmental awareness and responsibility among citizens

Corporate Goals and Strategic Vision:
- Enable real-time progress tracking and feedback from local authorities
- Offer a free, user-friendly application that can be seamlessly integrated into the daily lives of local residents, particularly in the city of Iași
- Support sustainability initiatives and potentially attract investment by presenting Iași as an environmentally responsible and technologically forward-thinking city, especially in the context of European Union visibility and funding opportunities

### 1.5 References

IEEE Std 830-1998
IEEE Recommended Practice for Software Requirements Specifications
Institute of Electrical and Electronics Engineers (IEEE), Version 1998.
https://standards.ieee.org/standard/830-1998.html

- IEEE SRS Template Repository
System Requirements Specification Template (IEEE Format)
Author: Rick4470, Version 1.0, GitHub Repository, 2020.
https://github.com/rick4470/IEEE-SRS-Tempate

- Scholarly HTML Specification
Scholarly HTML: A W3C Community Proposal for Semantically Rich Scientific Documents
Authors: W3C Community Group, Draft Version, Ongoing Work.
https://w3c.github.io/scholarly-html/

- Software Quality Checklist
Technical Reference: Software Checklist for Quality Requirements
Maintained by: Technical Reference Documentation Team, Version: Latest, 2021.
https://technical-reference.readthedocs.io/en/latest/quality/software-checklist.html

- Web Development Checklist
Toptal WebDevChecklist: Best Practices for Web Projects
Maintained by: Toptal Engineering Team, Version: Latest, 2022.
https://www.toptal.com/developers/webdevchecklist

- Web Technologies Course — Prof. Sabin Buraga
Web Technologies – Course Materials and Project Guidelines
Author: Prof. Sabin Buraga, Faculty of Computer Science, Alexandru Ioan Cuza University of Iași, 2024.
https://edu.info.uaic.ro/web-technologies/web-projects.html

- Web Development Course — Prof. Andrei Panu
Web Programming Laboratory Resources
Author: Prof. Andrei Panu, Faculty of Computer Science, Alexandru Ioan Cuza University of Iași, 2024.
https://profs.info.uaic.ro/andrei.panu/courses/web/lab/

- README Template Repository
Developer-Friendly Project README Template
Author: Louis3797, GitHub Repository, Version 1.0, 2021.
https://github.com/Louis3797

## Overall Description
### 2.1 Product Perspective

TidyTogether is an independent, self-contained software platform designed to operate seamlessly across both web and mobile environments. It is not a successor, extension, or replacement of any pre-existing waste management or geolocation system. While it is a standalone solution, its functionality is enhanced through the integration of a carefully selected set of external services and dependencies (see Section [2.7](#27-assumptions-and-dependencies)).

As a modern civic engagement tool, TidyTogether leverages lightweight, reliable technologies to deliver a scalable and sustainable solution. Its modular architecture allows it to remain autonomous while benefiting from robust, community-supported third-party services.

### 2.2 Product Functions

The core system enables the following key operations:

- Search and View of Recycling Locations: Civilians can browse and locate registered recycling sites using an interactive map and search interface.
- Report Polluted Areas: Civilians can submit reports regarding areas with significant waste accumulation, optionally attaching photos, location data, and comments.
- Validate Reports: Supervisors are responsible for reviewing and verifying civilian-submitted reports before escalating them to local authorities.
- Notify Authorities: Verified reports are forwarded to the appropriate local authorities, who are notified in real time to coordinate cleanup operations.
- Upload and Manage Recycling Sites: Local authorities can add, update, or remove official recycling site listings accessible to all users.
- Generate Technical Reports: Civilians can generate detailed reports (in HTML, CSV, or PDF formats) summarizing cleanup activities, unresolved issues, and status per neighborhood or city.

Further implementation details and functional workflows are described in Section [3](#external-interface-requirements).

### 2.3 User Classes and Characteristics

| Func | Civilians | Supervisors | Authority |
|:----:|:---------:|:-----------:|:---------:|
| frequency of use   | Occasional or situational (e.g., when noticing dirty areas) | daily | daily |
| product functions  | View recycling sites, report polluted zones | Validate or reject civilian reports | Add/update official recycling locations, confirm validated reports |
| technical expertise| Intermediate web/mobile usage(report forms, data exports) | Basic (familiar with validation workflows) | Intermediate (map administrative interface usage) |
| privilege levels   | Read areas, write reports | Read areas, read/write reports | Read/write areas, read/write reports |
| motivation  | hCivic engagement, desire to keep neighborhood clean | Maintaining data integrity and verifying user contributions | Managing waste response efforts; improving city hygiene |

### 2.4 Operating Environment

Operating System Compatibility: Platform-independent. The application is designed to function reliably on any modern operating system (Windows, macOS, Linux, Android, iOS), without version-specific constraints.

Web Compatibility: Accessible via all major modern browsers, including:
- Google Chrome (latest two versions)
- Mozilla Firefox (latest two versions)
- Microsoft Edge (Chromium-based, latest two versions)

Mobile Compatibility:
- Android: Version 9.0 (Pie) and above
- iOS: Version 13.0 and above

Backend Environment:
- Server: Linux-based server environment (e.g., Ubuntu, Debian)
- Database: MySQL or MariaDB

### 2.5 Design and Implementation Constraints

The design and development of TidyTogether must adhere to the following constraints, which define the boundaries within which the software must operate. These constraints include legal requirements, technical limitations, architectural decisions, and external dependencies:

- Legal and Regulatory Compliance
GDPR Compliance: The system must comply with the General Data Protection Regulation (GDPR) to ensure the protection of personal data collected from users, particularly civilians submitting reports or location-based data.

- Cross-Platform Compatibility - The application must be functional across
  - Web Browsers: Chrome, Firefox, Edge (latest two versions)
  - Mobile Devices: Android 9+ and iOS 13+
  - Operating Systems: No restrictions on operating system version for client access; the platform must run independently of specific OS constraints.
  - Backend Hosting: The backend must be deployed on a Linux-based server with a MySQL or MariaDB database.

- Third-Party APIs
  - [Leaflet](https://leafletjs.com/)
  - [ipify.org](https://api.ipify.org/?format=json)
  - [ip-api.com](https://ip-api.com/)
  - [nominatim.openstreetmap.org](https://nominatim.openstreetmap.org/ui/search.html)

- Third-Party Dependencies
  - [php-css-lint](https://github.com/neilime/php-css-lint)
  - [phpdotenv](https://github.com/vlucas/phpdotenv)
  - [mpdf](https://github.com/mpdf/phpdotenv)

- User Interface Constraints
  - The platform must provide an adaptive and responsive mobile interface to ensure usability across various screen sizes and input methods.
  - English

- Security Constraints
  - Secure communication protocols (HTTPS) are mandatory for all network interactions.
  - Sensitive user data must be securely stored and transmitted using industry best practices (e.g., hashed passwords, encrypted tokens).

- Development Standards and Conventions
  - Source code must adhere to commonly accepted best practices and naming conventions (e.g., PSR standards for PHP).
  - The platform must be developed using a modular architecture, MVC to allow scalability and maintainability.
  - Open-source technologies should be prioritized to reduce licensing constraints.

### 2.6 User Documentation

**General Access and Profile Management**

- **Signup Requirements**:
  - Supervisors and authorities require a special access key, communicated in advance via email, to complete registration.
- **Login Behavior**:
  - Upon successful login, users are redirected to their respective home dashboards.
- **Profile Navigation**:
  - All user types have access to a *Profile* button in the navigation bar.
  - This redirects to a panel displaying personal information: first name, last name, and preferred city (*mainCity*).
  - Users can edit their information or log out.
  - The *mainCity* field plays an important role in filtering content and personalizing views.

---

#### Civilian

- **Dashboard Functions**:
  - **Report Dirty Area**: Opens a form where the user manually inputs a description, address, neighborhood, city, country, photo, and tags.
  - **Saved Zones**: Lists previously saved locations by the user.
  - **Recycling Areas**: Displays all official recycling locations created by authorities on the map.
  - **My Location**: Centers the map on the user’s current location.
  - **mainCity**: Centers the map on the user’s preferred city for exploration or reporting.
  - **Map Interaction**:
    - Clicking on the map creates a marker and popup with the following options:
      - *Report Dirty Area*: Opens a pre-filled form with the selected coordinates.
      - *Save*: Adds the location to the user's saved zones.
      - *Generate Report*: Creates a report for the neighborhood corresponding to the marker's location.
- **Other Options**:
  - *Previous Reports*: Lists reports the user submitted in the past.
  - *City Report*: Generates a summary report based on the user’s selected *mainCity*.

---

#### Supervisor

- **Navigation**: Includes *Home* and *Profile*.
- **Main Functionality**:
  - Based on the *mainCity* preference, the supervisor sees all civilian-submitted reports for that area.
  - Each report may be accepted or rejected:
    - *Accepting* sends it to the authority's dashboard.
    - *Rejecting* deletes the report permanently.

---

#### Authority

- **Navigation**: Includes *Home*, *Areas*, and *Profile*.
- **Home Dashboard**:
  - Displays all validated reports from supervisors within the *mainCity*.
  - Shows detailed information from the initial report form.
- **Areas Dashboard**:
  - Allows the creation of official recycling zone markers, restricted to the selected *mainCity*.
  - *Posted Areas*: Lists all created recycling zones by the authority.
  - *My Location*: Centers the map on the authority’s real-time location.
  - *Map Interaction*: Clicking on the map opens a popup to create a new recycling spot, followed by a form specifying waste categories handled at that location.

### 2.7 Assumptions and Dependencies

The following assumptions and external dependencies are relevant to the continued operation and functionality of the TidyTogether application:

- **Internet Connectivity**: All users are expected to have access to a stable internet connection when interacting with the platform on both web and mobile devices.
- **Availability of External Services**: The following third-party services are assumed to remain freely accessible and operational:
  - [Wasmer](https://wasmer.io/) – for lightweight execution of WebAssembly modules.
  - [Leaflet](https://leafletjs.com/) – for map rendering and interaction.
  - [ipify.org](https://api.ipify.org/?format=json) – for obtaining public IP addresses.
  - [ip-api.com](https://ip-api.com/) – for IP-based geolocation.
  - [nominatim.openstreetmap.org](https://nominatim.openstreetmap.org/ui/search.html) – for geocoding and reverse geocoding services.
- **Integrity of Development Dependencies**: The following tools and libraries are presumed to remain functional, free to use, and actively maintained:
  - [php-css-lint](https://github.com/neilime/php-css-lint)
  - [phpdotenv](https://github.com/vlucas/phpdotenv)
  - [mpdf](https://github.com/mpdf/mpdf)

If any of these assumptions prove to be invalid or if dependencies become deprecated, monetized, or unstable, the overall reliability and performance of the platform may be negatively affected. Continuous monitoring and contingency planning are advised to mitigate such risks.

## External Interface Requirements

### 3.1 User Interfaces

TidyTogether provides a modern, responsive user interface tailored to each of the three user roles: civilians, supervisors, and local authorities. The design emphasizes ease of use, clarity, and accessibility across both web and mobile platforms.

- **Common Elements**:
  - Navigation bar with role-specific links and a universal *Profile* button.
  - Responsive layout optimized for modern browsers (Chrome, Firefox, Edge) and mobile platforms (Android 9+, iOS 13+).
  - Interactive map for viewing and managing locations.
  - Standard UI components for form inputs, confirmation dialogs, modals, and status indicators.
  - Clear error messages, success toasts, and loading indicators.

- **Civilian Interface**:
  - Report dirty areas via a structured form (manual input or map interaction).
  - View and save recycling or dirty locations.
  - Generate reports for neighborhoods or cities.
  - Access previous submissions and update preferences.

- **Supervisor Interface**:
  - Dashboard listing all pending civilian reports filtered by the chosen *mainCity*.
  - Approve or reject reports with relevant status feedback.

- **Authority Interface**:
  - Dashboard displaying reports validated by supervisors.
  - Interface for creating and managing official recycling area markers.
  - Form for tagging types of waste per location.

Detailed UI specifications, including wireframes and screen flow diagrams, are documented separately in the *User Interface Specification*.

---

### 3.2 Hardware Interfaces

TidyTogether interacts with a limited set of hardware features, primarily through mobile devices and geolocation services:

- **GPS**:
  - Used for determining the user’s current location and centering map views.
  - Supports accurate geolocation tagging for reports and area markers.

- **Camera (optional)**:
  - Users may upload images when submitting reports using device-native file upload interfaces (not direct camera capture).

- **Internet Connectivity**:
  - A stable connection is required for most features, including data fetching, map rendering, and report submission.

---

### 3.3 Software Interfaces

TidyTogether depends on several reliable, third-party and open-source libraries for enhanced functionality:

- **Leaflet.js**:
  - Interactive map rendering and marker management.
  - Used across all user roles for location-based interactions.

- **Wasmer**:
  - Embedded WebAssembly runtime for improved performance in selected modules.

- **External APIs for Geolocation**:
  - [ipify.org](https://api.ipify.org/?format=json): Determines client’s public IP address.
  - [ip-api.com](https://ip-api.com/): Maps IP to approximate location.
  - [nominatim.openstreetmap.org](https://nominatim.openstreetmap.org/ui/search.html): Performs reverse geocoding.

- **Validation and Output Libraries**:
  - [php-css-lint](https://github.com/neilime/php-css-lint): Ensures consistent styling in PDF/HTML generation.
  - [phpdotenv](https://github.com/vlucas/phpdotenv): Securely loads environment variables.
  - [mpdf](https://github.com/mpdf/mpdf): Generates PDF documents from HTML content.

- **Backend**:
  - Hosted on a Linux server using PHP 8+.
  - Data persistence handled via MySQL (MariaDB compatible).

All these services are assumed to remain free and publicly available. They do not require payment or authentication under current usage conditions.

---

### 3.4 Communications Interfaces

TidyTogether ensures secure, efficient, and reliable communication between users, services, and components:

- **HTTPS**:
  - All traffic between client and server is encrypted using HTTPS to ensure data confidentiality and integrity.

- **REST API**:
  - JSON-based communication between the frontend and backend.
  - Stateless interactions support scalability and maintainability.

- **Error Handling & Messaging**:
  - Consistent format for server responses (success, failure, validation errors).
  - Client-side parsing and display follow accessibility and clarity standards.

These interfaces ensure that all user actions are tracked, validated, and securely transferred across system components.

## System Features

This section outlines the core features of the TidyTogether platform, structured by user role and system functionality. Each feature includes a priority level, a typical user interaction flow, and the corresponding functional requirements necessary to ensure expected behavior.

---

### 4.1 System Feature 1

#### 4.1.1 Description and Priority

This feature enables civilians to report areas in need of sanitation or attention by the local authorities. It includes optional photo upload and tagging.  
**Priority**: High

#### 4.1.2 Stimulus/Response Sequences

1. User logs into the platform.
2. Navigates to the *Report Dirty Area* option.
3. Selects or clicks on a map location.
4. Fills in the form with: description, address, neighborhood, city, country, optional photo, and tags.
5. Submits the report.
6. Receives confirmation that the report has been registered and is pending validation.

#### 4.1.3 Functional Requirements

- **4.1.3.1** The user can select a location directly from the interactive map.
- **4.1.3.2** The user can add descriptive details and upload an optional photo.
- **4.1.3.3** The system saves the submitted report with status: *unvalidated*.
- **4.1.3.4** A notification is sent to the supervisors for review.
- **4.1.3.5** Reports are bound to the city set in the user's *mainCity* profile setting.
- **4.1.3.6** The user may generate a PDF/HTML/CSV report for a specific neighborhood, including all data submitted.

---

### 4.2 System Feature 2

#### 4.2.1 Description and Priority

Supervisors are responsible for reviewing, approving, or rejecting civilian-submitted reports.  
**Priority**: Medium

#### 4.2.2 Stimulus/Response Sequences

1. Supervisor receives a push notification when new reports are available.
2. Logs in and accesses the *Home* dashboard filtered by their *mainCity*.
3. Reviews each report with full details and attached media.
4. Accepts or rejects reports.
5. Accepted reports are forwarded to local authorities.

#### 4.2.3 Functional Requirements

- **4.2.3.1** The supervisor can view all pending/unvalidated reports in their selected city.
- **4.2.3.2** The supervisor can approve or reject each report.
- **4.2.3.3** On approval, the system sends the report to the authority dashboard.
- **4.2.3.4** On rejection, the report is removed and not persisted further.
- **4.2.3.5** All actions are logged and timestamped for audit purposes.

---

### 4.3 System Feature 3

#### 4.3.1 Description and Priority

Authorities oversee recycling and sanitation infrastructure. They can create official recycling locations and track reports passed through supervisor validation.  
**Priority**: High

#### 4.3.2 Stimulus/Response Sequences

1. Authority receives a notification about a validated report.
2. Logs in and navigates to the *Home* or *Areas* interface.
3. Reviews report details and decides on an action.
4. May mark the location as resolved or create an official recycling marker.
5. May update or disable existing area entries.

#### 4.3.3 Functional Requirements

- **4.3.3.1** The authority can view validated reports specific to their *mainCity*.
- **4.3.3.2** The authority can create, edit, or remove recycling area markers.
- **4.3.3.3** On map interaction, the authority may define a new recycling point via a form specifying supported waste types.
- **4.3.3.4** Existing locations can be marked as *active* or *inactive*.
- **4.3.3.5** The system generates a record for every change, traceable by location and user.
- **4.3.3.6** A *Posted Areas* section lists all active locations submitted by the logged-in authority.

## Other Nonfunctional Requirements

### 5.1 Performance Requirements

- Response time must remain under **1 second** for all standard CRUD operations.
- The system must support at least **10,000 concurrent users** without degradation.
- Map-based interactions (e.g., placing markers, loading zones) should load within **2 seconds**.
- Report generation (PDF/CSV/HTML) should complete within **3 seconds** for a standard dataset.

---

### 5.2 Safety Requirements

- All reports submitted by civilians must undergo **manual validation** by supervisors before becoming visible to authorities or the public.
- Submitted locations must be constrained **within national borders** to prevent out-of-scope input.
- Image uploads are limited in size and type to prevent malicious file injection.
- Data is sanitized and validated before processing.

---

### 5.3 Security Requirements

- User authentication is handled via **email and password**, with role-based access control (civilian, supervisor, authority).
- All sensitive data must be **encrypted in transit (HTTPS)** and **at rest**.
- Only authorized roles can perform write operations on restricted entities (e.g., only authorities can create official locations).
- Login sessions must expire after **30 minutes of inactivity**.

---

### 5.4 Software Quality Attributes

- **Availability**: Minimum system uptime must be **99.9%**, monitored through automated health checks.
- **Portability**: The platform must be fully functional on:
  - Modern web browsers: Chrome, Firefox, Edge
  - Mobile devices: Android 9+ and iOS 13+
- **Usability**: Interfaces are tailored to each user role, with minimal input required and a focus on intuitive map interactions.
- **Maintainability**: The codebase will follow clean architecture principles, and dependency updates must not break functionality.
- **Scalability**: The backend must be capable of horizontal scaling to meet future demand.
- **Localization**: The UI must support **both Romanian and English**, with automatic language detection where possible.

---

### 5.5 Business Rules

- Only **authorities** can add or edit **official recycling locations**.
- All **civilian reports** must be reviewed and validated by **supervisors** before reaching authorities.
- Every report must carry one of the following statuses:
  - `unvalidated`
  - `approved`
  - `rejected`
- Archived data older than **2 years** will be stored in a separate, read-only environment.
- System interfaces must be **bilingual** (Romanian and English), with the default set by the user's browser or device language.

## Other Requirements

This section captures all remaining requirements not previously addressed, including data handling rules, legal obligations, internationalization efforts, and open questions that must be resolved prior to deployment.

---

### Appendix A: Glossary

- **CRUD**: Acronym for Create, Read, Update, Delete — standard database operations.
- **FCM**: Firebase Cloud Messaging — service used for sending push notifications to mobile clients.
- **GDPR**: General Data Protection Regulation — EU regulation governing user data protection and privacy.
- **Leaflet**: Open-source JavaScript library for interactive maps.
- **Wasmer**: Lightweight WebAssembly runtime used to run secure and fast modules.
- **MainCity**: A preferred city set by users in their profile, used to center views and generate location-specific reports.

---

### Appendix B: Analysis Models

- Diagrams and models to support analysis and design (such as:
  - **Entity-Relationship Diagrams** to outline database schema
  - **State-transition diagrams** for report status management
  - **Sequence diagrams** for major user interactions
- These diagrams will be included in a separate design specification document and linked here upon finalization.

---

### Appendix C: To Be Determined (TBD) List

The following items remain open and must be specified before final development stages:

1. **TBD-1**: Complete user interface wireframes for all user roles.
2. **TBD-2**: Finalize the full list of supervisor validation criteria.
3. **TBD-3**: Define and implement the user feedback and rating system.
4. **TBD-4**: Define rate limiting and spam prevention mechanisms.
5. **TBD-5**: Establish accessibility standards (WCAG compliance level).
6. **TBD-6**: Determine the frequency and method of data backup procedures.
