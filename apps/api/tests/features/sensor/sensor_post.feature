Feature: Register sensor
  In order to register new sensor
  As a logged user
  I want to register a new sensor

  Scenario: Register new sensor
    Given I send a POST request to "api/v1/sensor" with body:
    """
    {
        "name": "sensor"
    }
    """
    Then the response status code should be 201
    Then the response should be empty
