Feature: Login user
  In order to log the user on the platform
  As a common user
  I want to generate a JWT token

Background:
  Given there is a user:
    | email             | password |
    | user@user.com     | 12345678 |
  Scenario: Generate a JWT token
    Given I send a POST request to "api/v1/auth/login" with body:
    """
    {
        "email": "user@user.com",
        "password": "12345678"
    }
    """
    Then the response status code should be 200
    Then the response content should be:
    """
    {
      "token":"jwt-token"
    }
    """
