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
    * 4.2 [System Feature 2 (and so on)](#42-system-feature-2-and-so-on)
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

Ecrane intuitive cu acces diferențiat în funcție de rol

Funcționalități: hartă interactivă, butoane de raportare, validare, notificare

Describe the logical characteristics of each interface between the software product and the users. This may include sample screen images, any GUI standards or product family style guides that are to be followed, screen layout constraints, standard buttons and functions (e.g., help) that will appear on every screen, keyboard shortcuts, error message display standards, and so on. Define the software components for which a user interface is needed. Details of the user interface design should be documented in a separate user interface specification.

### 3.2 Hardware Interfaces

GPS pentru localizarea utilizatorului

Cameră foto (opțional, pentru poze la raport)

Describe the logical and physical characteristics of each interface between the software product and the hardware components of the system. This may include the supported device types, the nature of the data and control interactions between the software and the hardware, and communication protocols to be used.

### 3.3 Software Interfaces

Integrare cu:

Leaflet API

Firebase Push Notifications

PostgreSQL pentru stocare

Describe the connections between this product and other specific software components (name and version), including databases, operating systems, tools, libraries, and integrated commercial components. Identify the data items or messages coming into the system and going out and describe the purpose of each. Describe the services needed and the nature of communications. Refer to documents that describe detailed application programming interface protocols. Identify data that will be shared across software components. If the data sharing mechanism must be implemented in a specific way (for example, use of a global data area in a multitasking operating system), specify this as an implementation constraint.

### 3.4 Communications Interfaces

HTTPS pentru comunicare sigură

Push Notification (FCM)

REST API
Describe the requirements associated with any communications functions required by this product, including e-mail, web browser, network server communications protocols, electronic forms, and so on. Define any pertinent message formatting. Identify any communication standards that will be used, such as FTP or HTTP. Specify any communication security or encryption issues, data transfer rates, and synchronization mechanisms.

## System Features

This template illustrates organizing the functional requirements for the product by system features, the major services provided by the product. You may prefer to organize this section by use case, mode of operation, user class, object class, functional hierarchy, or combinations of these, whatever makes the most logical sense for your product.

### 4.1 System Feature 1

Don’t really say “System Feature 1.” State the feature name in just a few words.

4.1.1   Description and Priority

Permite raportarea locațiilor necunoscute sau deteriorate. Prioritate: Înaltă

 Provide a short description of the feature and indicate whether it is of High, Medium, or Low priority. You could also include specific priority component ratings, such as benefit, penalty, cost, and risk (each rated on a relative scale from a low of 1 to a high of 9).

4.1.2   Stimulus/Response Sequences

Utilizator deschide aplicația

Selectează „Raportează locație”

Introduce detalii + locație

Primește confirmare

 List the sequences of user actions and system responses that stimulate the behavior defined for this feature. These will correspond to the dialog elements associated with use cases.
4.1.3   Functional Requirements


4.1.3.1 Utilizatorul poate selecta locația pe hartă

4.1.3.2 Utilizatorul poate adăuga descriere și fotografie

4.1.3.3 Sistemul salvează raportul ca „nevalidat”

4.1.3.4 Trimite notificare către supervisori

 Itemize the detailed functional requirements associated with this feature. These are the software capabilities that must be present in order for the user to carry out the services provided by the feature, or to execute the use case. Include how the product should respond to anticipated error conditions or invalid inputs. Requirements should be concise, complete, unambiguous, verifiable, and necessary. Use “TBD” as a placeholder to indicate when necessary information is not yet available.
 
 Each requirement should be uniquely identified with a sequence number or a meaningful tag of some kind.

### 4.2 System Feature 2 (and so on)

4.2 Validate Reports (Supervisori)
4.2.1 Description and Priority
Supraveghetorii validează autenticitatea rapoartelor. Prioritate: Medie

4.2.2 Stimulus/Response Sequences
Supervisor primește notificare

Deschide lista rapoarte

Verifică și aprobă/respinge

4.2.3 Functional Requirements
4.2.3.1 Supervisor poate vedea toate rapoartele nevalidate

4.2.3.2 Poate aproba sau respinge fiecare raport

4.2.3.3 La aprobare, notificarea se trimite autorităților

4.3 Manage Locations (Autorități)
4.3.1 Description and Priority
Autoritățile pot publica locații oficiale și rezolva probleme raportate. Prioritate: Înaltă

4.3.2 Stimulus/Response Sequences
Primește notificări din rapoarte

Accesează locațiile afectate

Marchează ca „rezolvat” sau actualizează

4.3.3 Functional Requirements
4.3.3.1 Poate crea/edită/șterge locații

4.3.3.2 Primește notificări la validare

4.3.3.3 Poate marca locația ca „nefuncțională” sau „activă”

## Other Nonfunctional Requirements

### 5.1 Performance Requirements

Timp de răspuns sub 1 secundă pentru operațiuni CRUD

Suport pentru minim 10.000 utilizatori simultan

If there are performance requirements for the product under various circumstances, state them here and explain their rationale, to help the developers understand the intent and make suitable design choices. Specify the timing relationships for real time systems. Make such requirements as specific as possible. You may need to state performance requirements for individual functional requirements or features.

### 5.2 Safety Requirements

Validarea umană a rapoartelor pentru a preveni conținut malițios

Limitări asupra locației (nu poate fi în afara granițelor)

Specify those requirements that are concerned with possible loss, damage, or harm that could result from the use of the product. Define any safeguards or actions that must be taken, as well as actions that must be prevented. Refer to any external policies or regulations that state safety issues that affect the product’s design or use. Define any safety certifications that must be satisfied.

### 5.3 Security Requirements

Autentificare prin email/parolă și roluri

Datele criptate în tranzit și în repaus

Specify any requirements regarding security or privacy issues surrounding use of the product or protection of the data used or created by the product. Define any user identity authentication requirements. Refer to any external policies or regulations containing security issues that affect the product. Define any security or privacy certifications that must be satisfied.

### 5.4 Software Quality Attributes

Disponibilitate: 99.9% uptime

Portabilitate: Web + Mobile

Ușurință în utilizare: Interfață adaptată fiecărui rol

Specify any additional quality characteristics for the product that will be important to either the customers or the developers. Some to consider are: adaptability, availability, correctness, flexibility, interoperability, maintainability, portability, reliability, reusability, robustness, testability, and usability. Write these to be specific, quantitative, and verifiable when possible. At the least, clarify the relative preferences for various attributes, such as ease of use over ease of learning.

### 5.5 Business Rules

Doar autoritățile pot adăuga locații „oficiale”

Raportele de la civili trebuie validate

Fiecare raport trebuie să aibă un status: „nevalidat”, „aprobat”, „respins”

Localizare în limba română și engleză

Arhivarea datelor mai vechi de 2 ani
List any operating principles about the product, such as which individuals or roles can perform which functions under specific circumstances. These are not functional requirements in themselves, but they may imply certain functional requirements to enforce the rules.

## Other Requirements

Define any other requirements not covered elsewhere in the SRS. This might include database requirements, internationalization requirements, legal requirements, reuse objectives for the project, and so on. Add any new sections that are pertinent to the project.

### Appendix A: Glossary

CRUD: Create, Read, Update, Delete

FCM: Firebase Cloud Messaging

Define all the terms necessary to properly interpret the SRS, including acronyms and abbreviations. You may wish to build a separate glossary that spans multiple projects or the entire organization, and just include terms specific to a single project in each SRS.

### Appendix B: Analysis Models
Optionally, include any pertinent analysis models, such as data flow diagrams, class diagrams, state-transition diagrams, or entity-relationship diagrams.

### Appendix C: To Be Determined List
TBD: Design UI Screens

TBD: Lista completă de validări pentru supervisori

TBD: Sistem de feedback pentru utilizatori

Collect a numbered list of the TBD (to be determined) references that remain in the SRS so they can be tracked to closure.
