@simple-product @category
Feature: Show the 3 most expensive products of a category in a widget
  In order to focus customer attention on exclusive products
  As a store owner
  I want to be able to show the 3 most expensive products from a category of my choice

  Scenario: Exclusive products widget type
    Given I am logged in as an administrator
    And I visit the new widget instance addition page
    When I click the widget Type drop-down
    Then I should see the Exclusive Products widget option