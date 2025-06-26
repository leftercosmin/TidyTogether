<div align="center">

  <img src="doc/logo.png" alt="logo" width="200" height="auto" />
  <h1>TidyTogether</h1>
  
  <p>
    A web application to manage information related to the collection, sorting, and recycling of gargabe
  </p>

<!-- Badges -->
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
    <a href="https://github.com/leftercosmin/TidyTogether">Documentation</a>
  <span> · </span>
    <a href="https://github.com/leftercosmin/TidyTogether/issues/">Report Bug</a>
  <span> · </span>
    <a href="https://github.com/leftercosmin/TidyTogether/issues/">Request Feature</a>
  </h4>
</div>

<br />

<!-- Table of Contents -->

# :notebook_with_decorative_cover: Table of Contents

- [About the Project](#star2-about-the-project)
  - [Screenshots](#camera-screenshots)
  - [Tech Stack](#space_invader-tech-stack)
  - [Features](#dart-features)
  - [Color Reference](#art-color-reference)
  - [Environment Variables](#key-environment-variables)
- [Getting Started](#toolbox-getting-started)
  - [Prerequisites](#bangbang-prerequisites)
  - [Installation](#gear-installation)
  - [Running Tests](#test_tube-running-tests)
  - [Run Locally](#running-run-locally)
  - [Deployment](#triangular_flag_on_post-deployment)
- [Usage](#eyes-usage)
- [Roadmap](#compass-roadmap)
- [Contributing](#wave-contributing)
  - [Code of Conduct](#scroll-code-of-conduct)
- [FAQ](#grey_question-faq)
- [License](#warning-license)
- [Contact](#handshake-contact)
- [Acknowledgements](#gem-acknowledgements)

<!-- About the Project -->

## :star2: About the Project

<!-- Screenshots -->

### :camera: Screenshots

<div align="center"> 
  <img src="https://placehold.co/600x400?text=Your+Screenshot+here" alt="screenshot" />
</div>

<!-- TechStack -->

### :space_invader: Tech Stack

- XAMPP

<details>
  <summary>Client</summary>
  <ul>
    <li><a href="https://www.typescriptlang.org/">Typescript</a></li>
    <li><a href="https://nextjs.org/">Next.js</a></li>
    <li><a href="https://reactjs.org/">React.js</a></li>
    <li><a href="https://tailwindcss.com/">TailwindCSS</a></li>
  </ul>
</details>

<details>
  <summary>Server</summary>
  <ul>
    <li><a href="https://www.typescriptlang.org/">Typescript</a></li>
    <li><a href="https://expressjs.com/">Express.js</a></li>
    <li><a href="https://go.dev/">Golang</a></li>
    <li><a href="https://nestjs.com/">Nest.js</a></li>
    <li><a href="https://socket.io/">SocketIO</a></li>
    <li><a href="https://www.prisma.io/">Prisma</a></li>    
    <li><a href="https://www.apollographql.com/">Apollo</a></li>
    <li><a href="https://graphql.org/">GraphQL</a></li>
  </ul>
</details>

<details>
<summary>Database</summary>
  <ul>
    <li><a href="https://www.mysql.com/">MySQL</a></li>
    <li><a href="https://www.postgresql.org/">PostgreSQL</a></li>
    <li><a href="https://redis.io/">Redis</a></li>
    <li><a href="https://neo4j.com/">Neo4j</a></li>
    <li><a href="https://www.mongodb.com/">MongoDB</a></li>
  </ul>
</details>

<details>
<summary>DevOps</summary>
  <ul>
    <li><a href="https://www.docker.com/">Docker</a></li>
    <li><a href="https://www.jenkins.io/">Jenkins</a></li>
    <li><a href="https://circleci.com/">CircleCLI</a></li>
  </ul>
</details>

<!-- Features -->

### :dart: Features

- three different perspectives
- responsive UI
- map geolocation
- favorite zones
- media storage

<!-- Color Reference -->

### :art: Color Reference

| Color           | Hex                                                              |
| --------------- | ---------------------------------------------------------------- |
| Primary Color   | ![#222831](https://via.placeholder.com/10/222831?text=+) #222831 |
| Secondary Color | ![#393E46](https://via.placeholder.com/10/393E46?text=+) #393E46 |
| Accent Color    | ![#00ADB5](https://via.placeholder.com/10/00ADB5?text=+) #00ADB5 |
| Text Color      | ![#EEEEEE](https://via.placeholder.com/10/EEEEEE?text=+) #EEEEEE |

<!-- Env Variables -->

### :key: Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`API_KEY`

`ANOTHER_API_KEY`

<!-- Getting Started -->

## :toolbox: Getting Started

<!-- Prerequisites -->

### :bangbang: Prerequisites

- [documentation](https://docs.google.com/document/d/1-aHo15U2-sPB9klRUCRxpozfseOrwraKnAo_gaaENro/edit?tab=t.0)
- [database](https://appdb-dyh6iv7f0wnm.adminer.wasmer.app/?server=db.be-mons1.bengt.wasmernet.com%3A3306&username=edd1c866799d80002ba7aff986fa&db=TidyTogether&dbid=appdb_KwGIWtwaUVoe&magiclogin=wott_43Z3T2ZQK34DMBOLDR56TXOAZWYZI2VX)

This project uses Yarn as package manager

- [mpdf](https://github.com/vlucas/phpdotenv)
- [phpdotenv](https://github.com/vlucas/phpdotenv)

```bash
 npm install --global yarn
```

<!-- Installation -->

### :gear: Installation

Install my-project with npm

```bash
  yarn install my-project
  cd my-project
```

<!-- Running Tests -->

### :test_tube: Running Tests

To run tests, run the following command

```bash
  yarn test test
```

<!-- Run Locally -->

### :running: Run Locally

## Build

Both Linux and Windows compatible

```sh
./bin/build.sh
./bin/startServer.sh
./bin/startServer.sh reset
```

Clone the project

```bash
  git clone https://github.com/leftercosmin/TidyTogether.git
```

Go to the project directory

```bash
  cd my-project
```

Install dependencies

```bash
  yarn install
```

Start the server

```bash
  yarn start
```

<!-- Deployment -->

### :triangular_flag_on_post: Deployment

To deploy this project run

```bash
  yarn deploy
```

<!-- Usage -->

## :eyes: Usage

Use this space to tell a little more about your project and how it can be used. Show additional screenshots, code samples, demos or link to other resources.

```javascript
import Component from "my-project";

function App() {
  return <Component />;
}
```

<!-- Roadmap -->

## :compass: Roadmap

- [x] Todo 1
- [ ] Todo 2

<!-- Contributing -->

## :wave: Contributing

<a href="https://github.com/leftercosmin/TidyTogether/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=leftercosmin/TidyTogether" />
</a>

Contributions are always welcome!

See `contributing.md` for ways to get started.

<!-- Code of Conduct -->

### :scroll: Code of Conduct

Please read the [Code of Conduct](https://github.com/leftercosmin/TidyTogether/blob/master/CODE_OF_CONDUCT.md)

<!-- FAQ -->

## :grey_question: FAQ

- Question 1

  - Answer 1

- Question 2

  - Answer 2

<!-- License -->

## :warning: License

Distributed under the no License. See LICENSE.txt for more information.

<!-- Contact -->

## :handshake: Contact

- Lefter Cosmin
- Braha Petru

Your Name - [@twitter_handle](https://twitter.com/twitter_handle) - email@email_client.com

Project Link: [https://github.com/leftercosmin/TidyTogether](https://github.com/leftercosmin/TidyTogether)

<!-- Acknowledgments -->

## :gem: Acknowledgements

Use this section to mention useful resources and libraries that you have used in your projects.

- [Shields.io](https://shields.io/)
- [Awesome README](https://github.com/matiassingers/awesome-readme)
- [Emoji Cheat Sheet](https://github.com/ikatyang/emoji-cheat-sheet/blob/master/README.md#travel--places)
- [Readme Template](https://github.com/othneildrew/Best-README-Template)
- [@leftercosmin](https://github.com/leftercosmin)
