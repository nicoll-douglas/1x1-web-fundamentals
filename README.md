# Jiggy's Web Fundamentals

A website where I regularly post informational tutorials about web development fundamentals.

[![Link](https://img.shields.io/badge/Live_At-https://jwf.nicolldouglas.dev-3d56a0)](https://jwf.nicolldouglas.dev)

## Features

- Simple, informational, and easy to follow tutorials ☀️.
- Securely authenticate with OAuth 🛡️.
- Save, update and keep track of tutorial progress ✏️.
- Responsive and accessible UI 📱.

## Technologies

This project is built with the LAMP stack and has little to no usage of packages and frameworks.

### Stack

[![Stack](https://skillicons.dev/icons?i=html,css,js,php,mysql,ubuntu)](https://skillicons.dev)

## Demo

Coming soon

## Documentation

Coming soon

## Run Locally

If for whatever reason you wish to run this project locally, basic instructions are below. This project runs best on a LAMP setup with composer installed.

### 1. Installation 📦

Run Installation script:

```bash
git clone git@github.com:nicoll-douglas/jiggys-web-fundamentals.git
cd jiggys-web-fundamentals
composer install
```

### 2. Environment 🛠️

You will also be needing some environment variables; there is a `.env.example` in the `secrets` directory. Instructions also below:

```
APP_ENV= # development or production
DB_HOST= # your MySQL host name
DB_USER= # your database user
DB_PASS= # your user's password

# for this you will need to set up some OAuth credentials for a Google Cloud Platform project
GOOGLE_AUTH_REDIRECT_URI= # your Google OAuth redirect URI

# this is just for me to sync my production deployment with this remote repo
GITHUB_WEBHOOK_SECRET= # something secure
```

In the secrets folder you will also be needing a Google OAuth client secret to put there once you set up your OAuth credentials. Name it `google_oauth_client_secret.json`.

### 3. Database 📊

Run the following command to set up the MySQL database as well run the migrations:

```bash
composer run db:setup
```

Finally, make sure the repository is accessible to your Apache server in order to serve the content. Enjoy 👍.

## License

[MIT](https://choosealicense.com/licenses/mit/)
