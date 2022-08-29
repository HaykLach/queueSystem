
# Queue management system

System for Queue management


## Installation

Run these commands after clone

```bash
  composer install
```
    
## Run Locally

Clone the project

```bash
  git clone https://github.com/HaykLach/queueSystem.git
```

Go to the project directory

```bash
  cd queueSystem
```

Install dependencies

```bash
  composer install
```

Run tasks

```bash
  php index.php
```

See tasks

```bash
  php gettasks.php
```

## Documentation

If you want to add a new task create class in libraries/classes/tasks folder which should inherit from BaseTask.php class
and add that class to Queue::$queue. After which run

``` bash
  composer install
```


