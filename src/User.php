<?php

namespace Wenstudio\ZincPhp;

trait User
{
    /**
     * @param string $id        login username
     * @param string $name      desc
     * @param string $password  
     * @param string $role      admin|user
     * 
     * @return bool
     * 
     */
    public function user_create(string $id,  string $name, string $password, string $role = 'admin'): bool
    {
        if (empty($id) || empty($password)) {
            return false;
        }

        if (!in_array($role, ['admin', 'user'])) {
            return false;
        }

        // return {"message":"ok","id":"$id"}
        $resp = $this->client->request('POST', "/api/user", [
            'json' => [
                '_id' => $id,
                'name' => $name,
                'role' => $role,
                'password' => $password,
            ]
        ]);

        $arr = Api::json($resp);
        return $arr && $arr['message'] == 'ok';
    }

    public function user_update(string $id,  string $name, string $password, string $role = 'admin'): bool
    {
        return $this->create_user($id, $name, $password, $role);
    }

    public function user_delete(string $id): bool
    {
        // return {"message":"deleted","id":"$id"}
        $resp = $this->client->request('DELETE', "/api/user/$id");
        $arr = Api::json($resp);
        return $arr && $arr['message'] == 'deleted';
    }

    /**
     * List all users
     * 
     * @return array: [{
     *      "_id": "", 
     *      "name":"", 
     *      "role":"", 
     *      "created_at":"", 
     *      "updated_at":""
     *  }
     * ]
     */
    public function user_list(): array
    {
        $resp = $this->client->get('/api/user');
        $users = Api::json($resp);

        return $users;
    }

    /**
     * Login. should be called in try{}catch{} block, throws exception 400 when login failed.
     * 
     * @throws ClientException 400 Bad Request. user not exists.
     */
    public function user_login(string $id, string $password): bool
    {
        $resp = $this->client->request('POST', '/api/login', ['json' => [
            '_id' => $id,
            'password' => $password,
        ]]);

        return $resp->getStatusCode() == 200;
    }
}
