# magento setup

## Clone the project

Clone the project into your local file system:

```bash
git clone git@github.com:n3ur0m4nc3r/magento.git
```

## Install

In the project root run

    $ composer install

Point your magento host of choice (e.g. `www.magento.test`) to your web server in

```bash
/etc/hosts
```

Create an empty database and set up Magento

## Using Behat

Switch to the environment you serve Magento from, update base URL in `behat.yaml` to the host you chose in the previous step.
Make sure your chosen host is resolved in this environment (e.g. point it to `127.0.0.1` in `/etc/hosts`)

To run the tests, navigate to the project root and:

	$ bin/behat


