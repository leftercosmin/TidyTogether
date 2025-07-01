# Software Requirements Specification
## For TidyTogether
Prepared by Braha Petru and Lefter Cosmin,
2E3, Computer Science, FII, Iasi

01.07.2025

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

This document defines the software requirements for the TidyTogether application - a platform that facilitates the identification, localization, and management of recycling sites, involving three types of users: civilians, supervisors and local authorities. Information related to the collection, sorting, and recycling of waste is shared among these roles. Civilians may report spots where substantial amount of garbage has accumulated, which are first validated by supervisors and then sent directly to the local authoroties. the goal of facilitating clean-up efforts. 

The current version of the product is 1.0. This SRS describes the entire codebase of this software solution and does not neglect any part of it.

### 1.2 Document Conventions

Requirements are numbered in (Section)(Number) format (e.g. 4.1.3.1).

The important terms are `indented`.

`TBD` indicates requirements or information to be defined later.

### 1.3 Intended Audience and Reading Suggestions

Everyone is welcomed to stimulate their cortical pleasure with the present document. For those with limited time, it is advised to get along with the [README](./../README.md) document first. If more questions arise, they might be explained faster in [User Documentation](#26-user-documentation).

Users: Section 2.3 and 4.


Developers may find intersting the 4th and 5th sections.

Project Managers: Sections 1, 2 and 5.

Testers: Sections 3 and 4.

Local authorities: Sections 2.

Professors: all sections.

IT companies: Section 2.3 and 4.

marketing staff:Section 2.3 and 4

### 1.4 Product Scope

TidyTogether offers a collaborative platform where:

- Authorities publish recycling locations.
- Civilians can view them, and report dirty locations.
- Supervisors validate reports before authorities are notified.

By reporting civilians giving up a hand for local authorities to find dirty areas.
transparent data of the progress regarding the cleaning of the city.
supervisors validate the civilians' requests.
benefits: better temperature, eco life, cit atmosphere, long term mindfullness of every civilian
corporate goals: easy to track progress and real time feedback/status from the local authorities. being a free and easy to use product could be easily integrated the lifes of the locals here in iasi. as a business strategies: could attract investors and make a good image of the city for eyes of the european gouvernaments.

### 1.5 References

IEEE Std 830-1998: IEEE Recommended Practice for Software Requirements Specifications
- [Buraga-Sabin-Course](https://edu.info.uaic.ro/web-technologies/web-projects.html)
- [Panu-Andrei-Course](https://profs.info.uaic.ro/andrei.panu/courses/web/lab/)
[@Louis3797](https://github.com/Louis3797)
[c4]()
[sysReq](https://github.com/rick4470/IEEE-SRS-Tempate) / [scholarly](https://w3c.github.io/scholarly-html/)
[checklist1](https://technical-reference.readthedocs.io/en/latest/quality/software-checklist.html)
[checklist2](https://www.toptal.com/developers/webdevchecklist)
including title, author, version number, date, and source or location.

## Overall Description
### 2.1 Product Perspective

The app is a standalone web and mobile system that can integrate with geolocation services and map APIs.

not a follow-on member of a product family, and NOT a replacement for certain existing systems. This is a new, self-contained product. There are some components of larger systems: services - explain here

### 2.2 Product Functions

Vizualizare locații de reciclare

Raportare locații de către civili

Validare rapoarte de către supervisori

Notificare și gestionare de către autorități

Read of the raports made by city/zone

Details will be provided in Section 3

### 2.3 User Classes and Characteristics

| Func | Civilians | Supervisors | Authority |
|:----:|:---------:|:-----------:|:---------:|
|frequency of use   | | daily | daily |
|product functions  | area view and report zone | reports validation | report marking |
|technical expertise| | | |
|privilege levels   | read areas, write reports | read areas, read/write reports | read/write areas, read/write reports |

|educational level  | highschool, englush a2 | | |

### 2.4 Operating Environment

Any os, any version: Web: Browsere moderne (Chrome, Firefox, Edge)

Mobile: Android 9+ și iOS 13+

Backend: servere Linux, server baze de date Mysql

### 2.5 Design and Implementation Constraints

Respectarea GDPR (pentru protecția datelor civili)

Folosirea Leaflet API

Interfață mobilă adaptabilă

Describe any items or issues that will limit the options available to the developers. These might include: corporate or regulatory policies; hardware limitations (timing requirements, memory requirements); interfaces to other applications; specific technologies, tools, and databases to be used; parallel operations; language requirements; communications protocols; security considerations; design conventions or programming standards (for example, if the customer’s organization will be responsible for maintaining the delivered software).

### 2.6 User Documentation

Logarea

pentru s a trebuie cheie suplimentara comunicata in avans

daca aceasta va avea success veti fi redirectionati la home page

#### supervisor

-
-
-
-

#### authority

-
-
-
-

### 2.7 Assumptions and Dependencies

All TidyTogether consumers should have a stable internet connection while using the app.

Leaflet and Wasmer will stay available and out of charge.

Usability of the services that bring life to what TidyTogether means:

- [ipify.org](https://api.ipify.org/?format=json)
- [ip-api.com](https://ip-api.com/)
- [nominatim.openstreetmap.org](https://nominatim.openstreetmap.org/ui/search.html)

The correctness of the following dependencies:

- [php-css-lint](https://github.com/neilime/php-css-lint)
- [phpdotenv](https://github.com/vlucas/phpdotenv)
- [mpdf](https://github.com/mpdf/phpdotenv)


The project could be affected if these assumptions are incorrect, are not shared, or change. 

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
If there are performance requirements for the product under various circumstances, state them here and explain their rationale, to help the developers understand the intent and make suitable design choices. Specify the timing relationships for real time systems. Make such requirements as specific as possible. You may need to state performance requirements for individual functional requirements or features.
### 5.2 Safety Requirements
Specify those requirements that are concerned with possible loss, damage, or harm that could result from the use of the product. Define any safeguards or actions that must be taken, as well as actions that must be prevented. Refer to any external policies or regulations that state safety issues that affect the product’s design or use. Define any safety certifications that must be satisfied.
### 5.3 Security Requirements
Specify any requirements regarding security or privacy issues surrounding use of the product or protection of the data used or created by the product. Define any user identity authentication requirements. Refer to any external policies or regulations containing security issues that affect the product. Define any security or privacy certifications that must be satisfied.
### 5.4 Software Quality Attributes
Specify any additional quality characteristics for the product that will be important to either the customers or the developers. Some to consider are: adaptability, availability, correctness, flexibility, interoperability, maintainability, portability, reliability, reusability, robustness, testability, and usability. Write these to be specific, quantitative, and verifiable when possible. At the least, clarify the relative preferences for various attributes, such as ease of use over ease of learning.
### 5.5 Business Rules
List any operating principles about the product, such as which individuals or roles can perform which functions under specific circumstances. These are not functional requirements in themselves, but they may imply certain functional requirements to enforce the rules.

## Other Requirements
Define any other requirements not covered elsewhere in the SRS. This might include database requirements, internationalization requirements, legal requirements, reuse objectives for the project, and so on. Add any new sections that are pertinent to the project.
### Appendix A: Glossary
Define all the terms necessary to properly interpret the SRS, including acronyms and abbreviations. You may wish to build a separate glossary that spans multiple projects or the entire organization, and just include terms specific to a single project in each SRS.
### Appendix B: Analysis Models
Optionally, include any pertinent analysis models, such as data flow diagrams, class diagrams, state-transition diagrams, or entity-relationship diagrams.
### Appendix C: To Be Determined List
Collect a numbered list of the TBD (to be determined) references that remain in the SRS so they can be tracked to closure.


5. Other Nonfunctional Requirements
5.1 Performance Requirements
Timp de răspuns sub 1 secundă pentru operațiuni CRUD

Suport pentru minim 10.000 utilizatori simultan

5.2 Safety Requirements
Validarea umană a rapoartelor pentru a preveni conținut malițios

Limitări asupra locației (nu poate fi în afara granițelor)

5.3 Security Requirements
Autentificare prin email/parolă și roluri

Datele criptate în tranzit și în repaus

5.4 Software Quality Attributes
Disponibilitate: 99.9% uptime

Portabilitate: Web + Mobile

Ușurință în utilizare: Interfață adaptată fiecărui rol

5.5 Business Rules
Doar autoritățile pot adăuga locații „oficiale”

Raportele de la civili trebuie validate

Fiecare raport trebuie să aibă un status: „nevalidat”, „aprobat”, „respins”

Localizare în limba română și engleză

Arhivarea datelor mai vechi de 2 ani

Appendix A: Glossary
CRUD: Create, Read, Update, Delete

FCM: Firebase Cloud Messaging

TBD: To Be Determined

Appendix B: Analysis Models
TBD: Data Flow Diagram

TBD: ER Diagram

Appendix C: To Be Determined List
TBD: Design UI Screens

TBD: Lista completă de validări pentru supervisori

TBD: Sistem de feedback pentru utilizatori
