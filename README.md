# detroit
A development-ready PHP implementation of clean architecture

## Installation

```sh
composer require detroit/core
```

## Concepts
This package could help you build a modular monolithic applications.
Each module considered as a bounded context with contains at least below directory structure:

```
/src
    /orders
        /domain
            /aggregate
            /events
            /repositories
        /application
            /commands
            /queries
```
