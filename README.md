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
    <a href="https://github.com/leftercosmin/TidyTogether/">View Demo</a>
  <span> · </span>
    <a href="https://github.com/leftercosmin/TidyTogether/">Documentation</a>
  <span> · </span>
    <a href="https://github.com/leftercosmin/TidyTogether/issues/">Report Bug</a>
  <span> · </span>
    <a href="https://github.com/leftercosmin/TidyTogether/issues/">Request Feature</a>
  </h4>
</div>

<br />

# :notebook_with_decorative_cover: Table of Contents

- [About the Project](#star2-about-the-project)
  - [Screenshots](#camera-screenshots)
  - [Tech Stack](#space_invader-tech-stack)
  - [Features](#dart-features)
  - [Color Reference](#art-color-reference)
  - [Environment Variables](#key-environment-variables)
- [Getting Started](#toolbox-getting-started)
  - [Prerequisites](#bangbang-prerequisites)
  - [Run Locally](#running-run-locally)
  - [Deployment](#triangular_flag_on_post-deployment)
- [Roadmap](#compass-roadmap)
- [Contributing](#wave-contributing)
- [License](#warning-license)
- [Contact](#handshake-contact)
- [Acknowledgements](#gem-acknowledgements)

## :star2: About the Project

### :camera: Screenshots

<div style="display: grid; grid-template-columns: 1fr 1fr; justify-content: center; gap: 20px;"> 
<img src="doc/ss/Screenshot from 2025-06-26 08-58-16.png" alt="screenshot" width="480" height="300" />
<img src="doc/ss/Screenshot from 2025-06-26 08-58-33.png" alt="screenshot" width="480" height="300" />
<img src="doc/ss/Screenshot from 2025-06-26 08-58-44.png" alt="screenshot" width="480" height="300" />
<img src="doc/ss/Screenshot from 2025-06-26 08-58-50.png" alt="screenshot" width="480" height="300" />
<img src="doc/ss/Screenshot from 2025-06-26 08-58-56.png" alt="screenshot" width="480" height="300" />
<img src="doc/ss/Screenshot from 2025-06-26 08-59-04.png" alt="screenshot" width="480" height="300" />
</div>

### :space_invader: Tech Stack

- Client:

  [![HTML5](https://img.shields.io/badge/html5-017852.svg?style=for-the-badge&logo=html5&logoColor=000)](./app/view/home/authorityHomeView.php)
  [![CSS3](https://img.shields.io/badge/css3-017852.svg?style=for-the-badge&logo=css&logoColor=000)](./app/style/profile.css)
  [![JavaScript](https://img.shields.io/badge/JavaScript-017852?style=for-the-badge&logo=javascript&logoColor=000)](./app/javascript/mapFunctionality.js)

- Server (Xampp):

  [![PHP](https://img.shields.io/badge/php-8ebca6.svg?style=for-the-badge&logo=php&logoColor=000)](./app/controller/civilianController.php)
  [![Bash](https://img.shields.io/badge/bash_script-8ebca6.svg?style=for-the-badge&logo=gnu-bash&logoColor=000)](./bin/build.sh)
  [![PowerShell](https://img.shields.io/badge/PowerShell-8ebca6.svg?style=for-the-badge&logo=ps&logoColor=000)](./bin/build.cmd)

- Database:

  [![MySQL](https://img.shields.io/badge/mysql-F8EFE0.svg?style=for-the-badge&logo=mysql&logoColor=000)](./bin/resetSchema.sh)

### :dart: Features

- three different perspectives
- responsive UI
- map geolocation
- favorite zones
- media storage

### :art: Color Reference

| Color                                               | Hex     |
| --------------------------------------------------- | ------- |
| <span style="color: #017852">Primary Color</span>   | #017852 |
| <span style="color: #8ebca6">Secondary Color</span> | #8ebca6 |
| <span style="color: #F8EFE0">Accent Color</span>    | #F8EFE0 |
| <span style="color: #E62C20">Status Color</span>    | #E62C20 |
| <span style="color: #FFAC25">Status Color</span>    | #FFAC25 |
| <span style="color: #0C5460">Status Color</span>    | #0C5460 |
| <span style="color: #000000">Text Color</span>      | #000000 |

### :key: Environment Variables

To run this project, you will need to add the following [variables](.env.example) to your .env file

## :toolbox: Getting Started

### :bangbang: Prerequisites

- [documentation](https://docs.google.com/document/d/1-aHo15U2-sPB9klRUCRxpozfseOrwraKnAo_gaaENro/edit?tab=t.0)
- [database](https://appdb-dyh6iv7f0wnm.adminer.wasmer.app/?server=db.be-mons1.bengt.wasmernet.com%3A3306&username=edd1c866799d80002ba7aff986fa&db=TidyTogether&dbid=appdb_KwGIWtwaUVoe&magiclogin=wott_43Z3T2ZQK34DMBOLDR56TXOAZWYZI2VX)

This project uses Composer as package manager

- [php-css-lint](https://github.com/neilime/php-css-lint)
- [phpdotenv](https://github.com/vlucas/phpdotenv)
- [mpdf](https://github.com/mpdf/phpdotenv)

### :test_tube: Running Linter

To run the Css Linter, run the following command

```bash
  php vendor/bin/php-css-lint app/style/path-to-file.css
  php vendor/bin/php-css-lint app/style/civilianHome.css
  php vendor/bin/php-css-lint app/style/globals.css
```

### :running: Run Locally

Clone the project

```bash
  git clone https://github.com/leftercosmin/TidyTogether.git
```

Go to the project directory

```bash
  cd TidyTogether
```

Install dependencies

```bash
  composer install
```

Start the server with these scripts: Both Linux and Windows compatible

```sh
./bin/build.sh
./bin/startServer.sh
./bin/startServer.sh reset
```

### :triangular_flag_on_post: Deployment

To deploy this project, configure it according to:

- [workflow](.github/workflows/ci.yml)
- [yaml](app.yaml)
- [toml](wasmer.toml)
- all the source code must be inside of the [app](./app/index.php) directory

## :compass: Roadmap

- [x] README
- [x] C4 diagrams
- [ ] System Requirments
- [ ] Checklist
- [ ] video

- [ ] favorite zone press
- [ ] load map based on mainCity
- [ ] download pdf
- [ ] paths

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
