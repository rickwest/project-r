![Project-R](public/images/logo.svg)

Project-R is a prototype social media style application, built as part of my Applications, Architectures and Frameworks uni module.
It is designed specifically to highlight some of the benefit's of using a web application framework. 

Those benefits include, but not limited to:
- Good documentation and support
- Efficiency, in both cost and development velocity
- Security
- Integrations with other software solutions

Whilst only a prototype, this application does include much of the core functionality for an application of this type. For example, the ability to register, login, edit your profile, create posts with images and also comment and like given posts. 

---

## Framework and Technologies

This application is built using [Laravel](https://laravel.com/). Laravel is an MVC framework and not only is it the most popular PHP framework, it is also one of the most popular backend frameworks in the world.

The reason for choosing Laravel for this project was primarily a result of it's popularity and the community surrounding it, but also because it offers a number official integrations with third party solutions such as [AWS S3](https://aws.amazon.com/s3/) for object storage, [Algolia](https://www.algolia.com/) for search and [Pusher](https://pusher.com/) for real-time pub-sub messaging.
Considering my project brief, I quickly identified that integrations like these could quickly and easily help me add core functionality to this application.

Due to the nature of the domain of this application, Project-R also implements much of its view layer utilising the [Vue.js](https://vuejs.org/) JavaScript framework.
Laravel provides easy integration with Vue.js out of the box and owing to the fact that Vue.js is a progressive JavaScript framework, I was able to use it to add dynamic components without having to build a complete single page application, thus significantly reducing development time.

---
 
## Getting started

### Requirements

* PHP 7.2 or higher;
* [Composer](https://getcomposer.org/)
* [Node.js and NPM](https://nodejs.org/en/)

### Installation
 
#### Clone the repo               
To get started with the installation of this project, first clone the repository:

```bash
git clone https://github.com/rickwest/project-r.git
```

#### Install dependencies
Then install the dependencies:

```bash
composer install
```

#### Install JavaScript dependencies and build the assets
Followed by the installation of the javascript dependencies:

```bash
npm install
```

You can then build the projects assets:
```bash
npm run dev
```

#### .env
The config for you application is defined in a `.env` file. To generate this, simply copy the `.env.example` template.

```cp .env.example .env``` 

**Whilst in `.env` you should also add your AWS, Algolia and Pusher credentials:**

#### Database
Next, you will need to configure and create a database. The example `.env` includes the default config for an SQLite database, so in this case, you can move straight onto the next steps, migrating and seeding the database. 

#### Migrate the database
Now you have configured the database connection you can migrate the database by running:

```bash
php artisan migrate
```

#### Seed the database
Laravel provides a convenient way to seed the database with demo data for testing and development:

```bash
php artisan db:seed
```

#### Authentication
As well as populating the database with demo data, the seed command also creates a user.
Log in to the system wih these credentials:

**email: user@shu.ac.uk**

**password: 20E!xI&$Zx**

### Usage

If you've got this far then you should be all set and ready to run the application. You can configure a web server like Nginx or Apache
but the easiest thing to do in development is simply run PHP's built in web server:

 ```bash
 php artisan serve
 ```

This should enable you to access <http://localhost:8000> in your browser. Navigate to `http://127.0.0.1:8000/login` and sign in with the credentials above.

### Tests
The important functionality of the project is covered by feature test. You can run the test suite by executing the following command from the root directory of the project:

```bash
./vendor/bin/phpunit
```

### Support
If you need some help or want to ask anything just drop me an [email](mailto:b7042643@my.shu.ac.uk).
