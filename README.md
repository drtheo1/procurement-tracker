# Procurement Request Tracker

A web application that lets employees submit procurement requests and lets managers
review, approve, or reject them. Built as the mini project for Software Development
Basics at CODE University of Applied Sciences, Berlin.

## The problem

In most organisations purchase requests travel by email and spreadsheet. Approvals
stall, nobody knows the current status of a request, and there is no single record
of who approved what. This application gives every request one record with a clear
owner, category, and outcome.

## Tech stack

- Laravel (PHP)
- Blade templating
- SQLite database
- Livewire starter kit for authentication
- Pest for testing, Pint for code style, PHPStan for static analysis
- GitHub Actions for continuous integration

## Data model

### User
| Field | Type | Notes |
|---|---|---|
| id | integer | primary key |
| name | string | |
| email | string | unique |
| password | string | hashed |
| role | string | employee, manager, or admin |

### Category
| Field | Type | Notes |
|---|---|---|
| id | integer | primary key |
| name | string | |
| description | text | nullable |

### Request
| Field | Type | Notes |
|---|---|---|
| id | integer | primary key |
| title | string | |
| description | text | |
| quantity | integer | |
| estimated_cost | decimal(12,2) | decimal rather than float to avoid rounding errors |
| status | string | pending, approved, or rejected |
| request_date | date | |
| user_id | foreign key | the employee who raised it |
| category_id | foreign key | the category it belongs to |

### Relationships

- A User has many Requests
- A Request belongs to a User
- A Category has many Requests
- A Request belongs to a Category

### Note on the model naming

The original project proposal named this model `ProcurementRequest`. Following
review feedback it was renamed to `Request`, and the missing `category_id` foreign
key was added so that the Request to Category relationship can actually be
expressed in the database.

Because Laravel ships its own `Illuminate\Http\Request` class, controllers that
need both import the HTTP class under an alias:

    use App\Models\Request;
    use Illuminate\Http\Request as HttpRequest;

## Routes

### Public
| Method | URI | Purpose |
|---|---|---|
| GET | / | Welcome page |
| GET | /about | About the project |
| GET | /contact | Contact details |

### Authentication
| Method | URI | Purpose |
|---|---|---|
| GET, POST | /login | Log in |
| GET, POST | /register | Create an account |
| POST | /logout | Log out |

### Requests (authenticated)
| Method | URI | Purpose |
|---|---|---|
| GET | /requests | List the user's requests |
| GET | /requests/create | Form to raise a request |
| POST | /requests | Store a new request |
| GET | /requests/{id} | View one request |
| GET | /requests/{id}/edit | Edit a pending request |
| PUT | /requests/{id} | Update a request |
| DELETE | /requests/{id} | Delete a request |

### Admin (manager and admin roles)
| Method | URI | Purpose |
|---|---|---|
| GET | /admin/dashboard | Overview of all requests |
| GET | /admin/requests | Manage all requests |
| PATCH | /admin/requests/{id}/approve | Approve a request |
| PATCH | /admin/requests/{id}/reject | Reject a request |
| GET | /admin/users | Manage users |

## Running the project locally

Requirements: PHP 8.3 or higher, Composer, Node.js, Git.

    git clone https://github.com/drtheo1/procurement-tracker.git
    cd procurement-tracker
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    touch database/database.sqlite
    php artisan migrate --seed
    composer run dev

The application is then available at http://localhost:8000

## Quality checks

The full continuous integration chain runs with:

    composer ci:check

This runs Pint for code style, PHPStan for static analysis, and the Pest test
suite. GitHub Actions runs the same chain on every push.

## Project status

Completed:

- Public welcome, about, and contact pages
- Registration, login, logout, and email verification
- Database schema for users, categories, and requests
- Eloquent models with relationships

In progress:

- Seed data
- Request creation, listing, editing, and deletion
- Role based access control
- Admin dashboard with approve and reject actions
- User management

## Author

Richard Theophilus Dartey
MSc Technology and Management, CODE University of Applied Sciences, Berlin