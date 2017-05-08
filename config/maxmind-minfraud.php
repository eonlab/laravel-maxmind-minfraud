<?php

return [

    /**
     * MaxMind user ID.
     *
     * @type integer
     */
    'user_id' => null,

    /**
     * MaxMind license key.
     *
     * @type string
     */
    'license_key' => null,

    /**
     * Response models.
     *
     * @type string[]
     */
    'response_models' => [
        'factors',
        'insights',
        'score',
    ],

    /**
     * Default response model.
     *
     * @type string
     */
    'default_response_model' => 'insights',

];
