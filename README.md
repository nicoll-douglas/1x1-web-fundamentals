# 1x1 Web Fundamentals

A simple website where I regularly post informational tutorials about web development fundamentals.

[![Link](https://img.shields.io/badge/Live_At-https://1x1.nicolldouglas.dev-3d56a0)](https://1x1.nicolldouglas.dev)

## Features

- Simple, informational, and easy to follow tutorials ☀️.
- Securely authenticate with OAuth 🛡️.
- Save, update and keep track of tutorial progress ✏️.
- Responsive and accessible UI 📱.

## Technologies

This project is built with the LAMP stack + Docker and has little to no usage of packages and frameworks.

### Stack

[![Stack](https://skillicons.dev/icons?i=html,css,js,php,mysql,ubuntu,docker)](https://skillicons.dev)

## Prerequisites

In order to run this project locally for development, make sure you have the following installed:

- [Docker Engine](https://docs.docker.com/engine/) or [Docker Desktop](https://docs.docker.com/desktop/)
- [GNU Make](https://www.gnu.org/software/make/)
- [Composer](https://getcomposer.org/)
- Google OAuth Credentials set up in the [Google Cloud Console](https://console.cloud.google.com/apis/credentials)

## Run Locally

### 1. Installation 📦

Run the following:

```bash
git clone https://github.com/nicoll-douglas/1x1-web-fundamentals.git
cd 1x1-web-fundamentals
composer install
```

### 2. Environment 🛠️

You will also be needing some environment variables; there is a `.env.example` in the `secrets` directory which you can clone in there and then rename it to `.env`. Instructions also below:

```
APP_ENV= # development or production
SESSION_COOKIE_DOMAIN= # domain for session cookies, (localhost or custom domain)

MYSQL_USER= # the name for your MySQL user
MYSQL_PASSWORD= # the password for the user
MYSQL_ROOT_PASSWORD= # password for the root user

GOOGLE_AUTH_REDIRECT_URI= # your Google OAuth redirect URI
```

In the secrets folder you will also need to put your Google OAuth client secret once you set up your OAuth credentials. It is a JSON file that you can download from the Google Cloud console. Name it `google_oauth_client_secret.json`.

### 3. Get up and running 🛠️

Run the following command to build the Docker images and run the containers:

```bash
make dev-up
```

Then, run the following command which sets up the database tables inside the MySQL container:

```bash
make setup-db
```

Finally, navigate to [http://localhost:8001](http://localhost:8000) or the appropriate location where the project should be accessible and you should be good to go!

## License

[MIT](https://choosealicense.com/licenses/mit/)
