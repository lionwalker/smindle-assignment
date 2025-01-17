# Smindle Order Management System

This project implements a Laravel-based order processing system with asynchronous subscription handling as per the assignment requirements.

## Setup Instructions

1. Clone the repository

    ``` bash
    git clone https://github.com/lionwalker/smindle-assignment.git
    cd smindle-assignment
    ```

2. Run shell file to do initial setup

    ``` bash
    sh entrypoint.sh
    ```

2. Start the application using Docker

    ``` bash
    docker compose up -d
    ```

## API Endpoints

1. Create Order
    - URL: http://localhost/api/v1/orders
    - Method: POST
    - Content-Type: application/json

    **Request Payload**

    ``` json
    {
        "first_name": "Alan",
        "last_name": "Turing",
        "address": "123 Enigma Ave, Bletchley Park, UK",
        "basket": [
            {
                "name": "Smindle ElePHPant plushie",
                "type": "unit",
                "price": 295.45
            },
            {
                "name": "Syntax & Chill",
                "type": "subscription",
                "price": 175.00
            }
        ]
    }
    ```

    **Success Response**

    ``` json
    {
        "data":{
            "id":13,
            "first_name":"Alan",
            "last_name":"Turing",
            "address":"123 Enigma Ave, Bletchley Park, UK",
            "basket":[
                {
                    "id":17,
                    "name":"Smindle ElePHPant plushie",
                    "type":"unit",
                    "price":295.45
                },
                {
                    "id":18,
                    "name":"Syntax & Chill",
                    "type":"subscription",
                    "price":175
                }
            ],
            "created_at":"2025-01-17T15:12:45.000000Z"
        }
    }
    ```
2. List Orders
    - URL: http://localhost/api/v1/orders
    - Method: GET
    - Query Parameters:
        - page: Page number (optional)
        - per_page: Items per page (optional, default: 5)

    **Success Response**

    ``` json
    {
        "data":[
            {
                "id":1,
                "first_name":"Alan",
                "last_name":"Turing",
                "address":"123 Enigma Ave, Bletchley Park, UK",
                "basket":[
                    {
                    "id":1,
                    "name":"Smindle ElePHPant plushie",
                    "type":"unit",
                    "price":295.45
                    },
                    {
                    "id":2,
                    "name":"Syntax & Chill",
                    "type":"subscription",
                    "price":175
                    }
                ],
                "created_at":"2025-01-17T16:07:02.000000Z"
            }
        ],
        "links":{
            "first":"http://localhost/api/orders?page=1",
            "last":"http://localhost/api/orders?page=1",
            "prev":null,
            "next":null
        },
        "meta":{
            "current_page":1,
            "from":1,
            "last_page":1,
            "links":[
                {
                    "url":null,
                    "label":"&laquo; Previous",
                    "active":false
                },
                {
                    "url":"http://localhost/api/orders?page=1",
                    "label":"1",
                    "active":true
                },
                {
                    "url":null,
                    "label":"Next &raquo;",
                    "active":false
                }
            ],
            "path":"http://localhost/api/orders",
            "per_page":5,
            "to":1,
            "total":1
        }
    }
    ```

## Implementation Details

### Requirements Fulfilled

- Order Endpoint
    - Created endpoint that receives the specified order payload
    - Implemented using API versioning for future maintainability

- Request Validation
    - Implemented Laravel Form Request validation
    - Order data is validated and saved to database

- Asynchronous Subscription Processing
    - Baskets with subscription type are processed asynchronously
    - Uses Laravel Events, Listeners, and Queue system
    - Sends subscription data to the specified third-party endpoint

## Technical Approach

    - Used API versioning (/api/v1/) for future extensibility
    - Implemented Laravel Form Request Validation for data validation
    - Used Laravel Resource for response formatting
    - Implemented Events and Listeners for subscription handling
    - Queue system processes subscriptions asynchronously

## Testing

    - Postman collection is included in the artifacts folder for API testing

## Future Improvements

    - Add unit and feature testing
    - Implement authentication system
    - Add seperate API documentation
    - Set up monitoring and logging

## Note

The code is structured to meet the assignment requirements while maintaining good practices and allowing for future scalability.