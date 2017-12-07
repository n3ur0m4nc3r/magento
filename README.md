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

## Acceptance Criteria:

```
Feature: Show the 3 most expensive products of a category in a widget
  In order to focus customer attention on exclusive products
  As a store owner
  I want to be able to show the 3 most expensive products from a category of my choice

  Scenario: Exclusive products widget type
    Given I am logged in as an administrator
    And I visit the new widget instance addition page
    When I click the widget Type drop-down
    Then I should see the Exclusive Products widget option

  Scenario: Render Exclusive products
    Given an Exclusive product type widget exists
    And the chosen category has at least "5" visible products
    And the widget is set to use the current design package
    And the widget is set to be rendered on "All pages"
    And the widget is set to be rendered in "Main Content Area"
    When I visit the Home page
    Then I should see the 3 most expensive products of the chosen category
```

