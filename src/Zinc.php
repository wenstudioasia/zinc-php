<?php

namespace Wenstudio\ZincPhp;

/**
 * @mixin Index
 * @mixin User
 */
class Zinc extends Api
{
    public function __construct(string $endpoint, string $username, string $password)
    {
        parent::__construct($endpoint, $username, $password);
    }

    use Index;
    use Document;
    use User;
    use Search;
}
