<div align="center">


  <img src="doc/tidytogether-logo.png" alt="logo" width="200" height="auto" />
  <h1>TidyTogether</h1>
  
  <p>
    A web application to manage information related to the collection, sorting, and recycling of gargabe
  </p>

<p>
  <a href="https://github.com/leftercosmin/TidyTogether/graphs/contributors">
    <img src="https://img.shields.io/github/contributors/leftercosmin/TidyTogether" alt="contributors" />
  </a>
  <a href="">
    <img src="https://img.shields.io/github/last-commit/leftercosmin/TidyTogether" alt="last update" />
  </a>
  <a href="https://github.com/leftercosmin/TidyTogether/network/members">
    <img src="https://img.shields.io/github/forks/leftercosmin/TidyTogether" alt="forks" />
  </a>
  <a href="https://github.com/leftercosmin/TidyTogether/stargazers">
    <img src="https://img.shields.io/github/stars/leftercosmin/TidyTogether" alt="stars" />
  </a>
  <a href="https://github.com/leftercosmin/TidyTogether/issues/">
    <img src="https://img.shields.io/github/issues/leftercosmin/TidyTogether" alt="open issues" />
  </a>
  <a href="https://github.com/leftercosmin/TidyTogether/blob/master/LICENSE">
    <img src="https://img.shields.io/github/license/leftercosmin/TidyTogether.svg" alt="license" />
  </a>
</p>
   
<h4>
    <a href="./doc/demo.mp4">View Demo</a>
  <span> · </span>
    <a href="./doc/requirements.md">System requirments</a>
  <span> · </span>
    <a href="https://github.com/leftercosmin/TidyTogether/issues/">Report Bug</a>
  <span> · </span>
    <a href="https://github.com/leftercosmin/TidyTogether/issues/">Request Feature</a>
  </h4>
</div>

<br />

# :notebook_with_decorative_cover: Table of Contents

- [About the Project](#star2-about-the-project)
  - [Features](#dart-features)
  - [Screenshots](#camera-screenshots)
  - [Tech Stack](#space_invader-tech-stack)
  - [Color Reference](#art-color-reference)
- [Getting Started](#toolbox-getting-started)
  - [Prerequisites](#bangbang-prerequisites)
  - [Environment Variables](#key-environment-variables)
  - [Run Locally](#running-run-locally)
  - [Deployment](#triangular_flag_on_post-deployment)
- [Roadmap](#compass-roadmap)
- [Contributing](#wave-contributing)
- [License](#warning-license)
- [Contact](#handshake-contact)
- [Acknowledgements](#gem-acknowledgements)

## :star2: About the Project

### :dart: Features

- three different perspectives

  - posting procedures for civilians
  - approval of their requests by supervisor (Mayor)
  - the executive forces responses (SalubrIs)

- map geolocation of waste collecting ares

  - city preference for every user
  - favorite zones and profile management

- signup protection for unauthorised personnel
- mime media types storage
- responsive UI

### :camera: Screenshots

<div style="display: grid; grid-template-columns: 1fr 1fr; justify-content: center; gap: 20px;"> 
<img src="doc/ss/Screenshot from 2025-06-26 08-58-16.png" alt="screenshot" width="240" height="150" />
<img src="doc/ss/Screenshot from 2025-06-26 08-58-33.png" alt="screenshot" width="240" height="150" />
<img src="doc/ss/Screenshot from 2025-06-26 08-58-44.png" alt="screenshot" width="240" height="150" />
<img src="doc/ss/Screenshot from 2025-06-26 08-58-50.png" alt="screenshot" width="240" height="150" />
<img src="doc/ss/Screenshot from 2025-06-26 08-58-56.png" alt="screenshot" width="240" height="150" />
<img src="doc/ss/Screenshot from 2025-06-26 08-59-04.png" alt="screenshot" width="240" height="150" />
</div>

### :space_invader: Tech Stack

#### Client:

[![HTML5](https://img.shields.io/badge/html5-017852.svg?style=for-the-badge&logo=html5&logoColor=000)](./app/view/home/authorityHomeView.php)
[![CSS3](https://img.shields.io/badge/css3-017852.svg?style=for-the-badge&logo=css&logoColor=000)](./app/style/profile.css)
[![JavaScript](https://img.shields.io/badge/JavaScript-017852?style=for-the-badge&logo=javascript&logoColor=000)](./app/javascript/mapFunctionality.js)

#### Server (Xampp):

[![PHP](https://img.shields.io/badge/php-8EBCA6.svg?style=for-the-badge&logo=php&logoColor=000)](./app/controller/civilianController.php)
[![Bash](https://img.shields.io/badge/bash_script-8EBCA6.svg?style=for-the-badge&logo=gnu-bash&logoColor=000)](./bin/build.sh)
[![PowerShell](https://img.shields.io/badge/PowerShell-8EBCA6.svg?style=for-the-badge&logo=ps&logoColor=000)](./bin/build.cmd)

#### Database:

[![MySQL](https://img.shields.io/badge/mysql-F8EFE0.svg?style=for-the-badge&logo=mysql&logoColor=000)](./bin/resetSchema.sh)

### :art: Color Reference

| Name            |   Hex   |              Color               |
| --------------- | :-----: | :------------------------------: |
| Primary Color   | #017852 | <img src="doc/color/color1.png"> |
| Secondary Color | #8EBCA6 | <img src="doc/color/color2.png"> |
| Accent Color    | #F8EFE0 | <img src="doc/color/color3.png"> |
| Status Color    | #E62C20 | <img src="doc/color/color4.png"> |
| Status Color    | #FFAC25 | <img src="doc/color/color5.png"> |
| Status Color    | #0C5460 | <img src="doc/color/color6.png"> |
| Text Color      | #000000 | <img src="doc/color/color7.png"> |

## :toolbox: Getting Started

### :bangbang: Prerequisites

- <a href="./doc/requirements.md">System requirments</a>
- [Documentation](https://docs.google.com/document/d/1-aHo15U2-sPB9klRUCRxpozfseOrwraKnAo_gaaENro/edit?tab=t.0)
- [Database](https://appdb-dyh6iv7f0wnm.adminer.wasmer.app/?server=db.be-mons1.bengt.wasmernet.com%3A3306&username=edd1c866799d80002ba7aff986fa&db=TidyTogether&dbid=appdb_KwGIWtwaUVoe&magiclogin=wott_43Z3T2ZQK34DMBOLDR56TXOAZWYZI2VX)

Services that bring life to what TidyTogether means:

- [Leaflet](https://leafletjs.com/)
- [ipify.org](https://api.ipify.org/?format=json)
- [ip-api.com](https://ip-api.com/)
- [nominatim.openstreetmap.org](https://nominatim.openstreetmap.org/ui/search.html)

This project uses Composer as package manager and the following dependencies:

- [php-css-lint](https://github.com/neilime/php-css-lint)
- [phpdotenv](https://github.com/vlucas/phpdotenv)
- [mpdf](https://github.com/mpdf/phpdotenv)

### :key: Environment Variables

To run this project, you will need to add the following [variables](.env.example) to your **.env** file. The "SERVER" variable should be declared only for the remote container (don't declare it locally).

### :running: Run Locally

Windows has our support too: use the `.cmd` scripts instead of `.sh` ones.

```bash
git clone https://github.com/leftercosmin/TidyTogether.git
cd TidyTogether
# closes the Apache server from Debian in Xampp's favor
./bin/startServer.sh
```

If "reset" is provided as argument `./bin/startServer.sh reset` - the database reached by you local **.env** is dropped and updated with [./bin/schema.sql](./bin/schema.sql)

```bash
# use this when you want to update the solution with you current directory
./bin/build.sh
# use this to have some default values in your database
./bin/insertSchema.sh
```

### :triangular_flag_on_post: Deployment

To deploy this project, configure it according to:

- [workflow](.github/workflows/ci.yml)
- [yaml](app.yaml)
- [toml](wasmer.toml)
- the source code must be inside of the [app](./app/index.php) directory

Then go to [Wasmer](https://wasmer.io/) and set up the remote **.env**. The "SERVER" variable is a must have here.

### :test_tube: Running Linter

To run the Css Linter, run the following command

```bash
php vendor/bin/php-css-lint app/style/path-to-file.css
php vendor/bin/php-css-lint app/style/civilianHome.css
php vendor/bin/php-css-lint app/style/globals.css
```

## :compass: Roadmap

- [x] C4 diagrams
- [x] Checklist
- [x] System Requirments
- [x] video

- [x] favorite zone press
- [x] load map based on mainCity
- [x] download pdf
- [x] paths

## :wave: Contributing

<a href="https://github.com/leftercosmin/TidyTogether/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=leftercosmin/TidyTogether" />
</a>

Contributions are always welcome!

## :warning: License

Distributed under the MIT License. See [this](./LICENSE) for more information.

## :handshake: Contact

- Lefter Cosmin: - [@linkedin](https://www.linkedin.com/in/petru-braha/) - lefcos30@gmail.com
- Braha Petru: - [@linkedin](https://www.linkedin.com/in/petru-braha/) - petrubraha@gmail.com
- Project Link: [https://github.com/leftercosmin/TidyTogether](https://github.com/leftercosmin/TidyTogether)

<!-- Acknowledgments -->

## :gem: Acknowledgements

Useful resources and libraries that you have used in your projects:

- [Shields.io](https://shields.io/)
- [Awesome README](https://github.com/matiassingers/awesome-readme)
- [Emoji Cheat Sheet](https://github.com/ikatyang/emoji-cheat-sheet/blob/master/README.md#travel--places)
- [Readme Template](https://github.com/othneildrew/Best-README-Template)
- [@Louis3797](https://github.com/Louis3797)
- [cheat-sheet](./doc/comm.md)
- [Buraga-Sabin-Course](https://edu.info.uaic.ro/web-technologies/web-projects.html)
- [Panu-Andrei-Course](https://profs.info.uaic.ro/andrei.panu/courses/web/lab/)
