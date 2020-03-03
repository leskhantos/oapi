---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.

<!-- END_INFO -->

#general


<!-- START_44652685eefa8022f19b92a3ce78d990 -->
## auth/login
> Example request:

```bash
curl -X POST \
    "http://localhost/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST auth/login`


<!-- END_44652685eefa8022f19b92a3ce78d990 -->

<!-- START_5d78aa5ef786d4cdb818ccf7e9a04a89 -->
## auth/logout
> Example request:

```bash
curl -X GET \
    -G "http://localhost/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET auth/logout`

`POST auth/logout`


<!-- END_5d78aa5ef786d4cdb818ccf7e9a04a89 -->

<!-- START_b25bea9b921111447db41e83ca0f4564 -->
## auth/user
> Example request:

```bash
curl -X GET \
    -G "http://localhost/auth/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/auth/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET auth/user`


<!-- END_b25bea9b921111447db41e83ca0f4564 -->

<!-- START_89966bfb9ab533cc3249b91a9090d3dc -->
## users
> Example request:

```bash
curl -X GET \
    -G "http://localhost/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/users"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET users`


<!-- END_89966bfb9ab533cc3249b91a9090d3dc -->

<!-- START_57a8a4ba671355511e22780b1b63690e -->
## users
> Example request:

```bash
curl -X POST \
    "http://localhost/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/users"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST users`


<!-- END_57a8a4ba671355511e22780b1b63690e -->

<!-- START_5693ac2f2e21af3ebc471cd5a6244460 -->
## users/{user}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/users/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/users/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET users/{user}`


<!-- END_5693ac2f2e21af3ebc471cd5a6244460 -->

<!-- START_7fe085c671e1b3d51e86136538b1d63f -->
## users/{user}
> Example request:

```bash
curl -X PUT \
    "http://localhost/users/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/users/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT users/{user}`

`PATCH users/{user}`


<!-- END_7fe085c671e1b3d51e86136538b1d63f -->

<!-- START_016be9c94f2604722c7c896afe9d829e -->
## put-users/{id}/pass
> Example request:

```bash
curl -X PUT \
    "http://localhost/put-users/1/pass" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/put-users/1/pass"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT put-users/{id}/pass`


<!-- END_016be9c94f2604722c7c896afe9d829e -->

<!-- START_88c00f19d9fa91a5b8d660f67f34533e -->
## spots/types
> Example request:

```bash
curl -X GET \
    -G "http://localhost/spots/types" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/spots/types"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET spots/types`


<!-- END_88c00f19d9fa91a5b8d660f67f34533e -->

<!-- START_30288d00684763012f2ffa791a366df5 -->
## spots
> Example request:

```bash
curl -X POST \
    "http://localhost/spots" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/spots"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST spots`


<!-- END_30288d00684763012f2ffa791a366df5 -->

<!-- START_d60755048491e3ec2e710964d37949ed -->
## add/sms
> Example request:

```bash
curl -X POST \
    "http://localhost/add/sms" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/add/sms"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST add/sms`


<!-- END_d60755048491e3ec2e710964d37949ed -->

<!-- START_d0e9e0d2c90286594a7682121dd8e869 -->
## add/call
> Example request:

```bash
curl -X POST \
    "http://localhost/add/call" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/add/call"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST add/call`


<!-- END_d0e9e0d2c90286594a7682121dd8e869 -->

<!-- START_5f6d0c3c3887ba0d57f8a032e49bdebe -->
## add/guest
> Example request:

```bash
curl -X POST \
    "http://localhost/add/guest" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/add/guest"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST add/guest`


<!-- END_5f6d0c3c3887ba0d57f8a032e49bdebe -->

<!-- START_323ae57f4c844a6a222f692ce5cc5f65 -->
## add/voucher
> Example request:

```bash
curl -X POST \
    "http://localhost/add/voucher" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/add/voucher"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST add/voucher`


<!-- END_323ae57f4c844a6a222f692ce5cc5f65 -->

<!-- START_1db01a764aa10ac7ebdbd9688d449054 -->
## add/device
> Example request:

```bash
curl -X POST \
    "http://localhost/add/device" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/add/device"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST add/device`


<!-- END_1db01a764aa10ac7ebdbd9688d449054 -->

<!-- START_14615e385e4229c8a1249de743772db6 -->
## spot/{id}/call
> Example request:

```bash
curl -X GET \
    -G "http://localhost/spot/1/call" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/spot/1/call"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET spot/{id}/call`


<!-- END_14615e385e4229c8a1249de743772db6 -->

<!-- START_6c316a476bc73f80409b6cd38b61ecaf -->
## spot/{id}/session
> Example request:

```bash
curl -X GET \
    -G "http://localhost/spot/1/session" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/spot/1/session"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET spot/{id}/session`


<!-- END_6c316a476bc73f80409b6cd38b61ecaf -->

<!-- START_94b5eaa43456542d01b27fc222c4952a -->
## spots/types/{id}/company
> Example request:

```bash
curl -X GET \
    -G "http://localhost/spots/types/1/company" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/spots/types/1/company"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET spots/types/{id}/company`


<!-- END_94b5eaa43456542d01b27fc222c4952a -->

<!-- START_50bc1ec7ad747cb5a92b20f1e3a28abf -->
## companies
> Example request:

```bash
curl -X GET \
    -G "http://localhost/companies" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/companies"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET companies`


<!-- END_50bc1ec7ad747cb5a92b20f1e3a28abf -->

<!-- START_e7bd487673efd23bf837eada79cd577c -->
## company
> Example request:

```bash
curl -X POST \
    "http://localhost/company" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/company"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST company`


<!-- END_e7bd487673efd23bf837eada79cd577c -->

<!-- START_ed25e8d68335d645f9260ef599be2b6a -->
## company/{company}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/company/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/company/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET company/{company}`


<!-- END_ed25e8d68335d645f9260ef599be2b6a -->

<!-- START_fd00e71dbf390128704f847ef0d3322d -->
## company/{company}
> Example request:

```bash
curl -X PUT \
    "http://localhost/company/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/company/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT company/{company}`

`PATCH company/{company}`


<!-- END_fd00e71dbf390128704f847ef0d3322d -->

<!-- START_4be001b7476ffa43709ac5c694ce236b -->
## company/{company}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/company/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/company/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE company/{company}`


<!-- END_4be001b7476ffa43709ac5c694ce236b -->

<!-- START_3d0601c017fd18931a777e60fda326e5 -->
## company/{id}/guests
> Example request:

```bash
curl -X GET \
    -G "http://localhost/company/1/guests" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/company/1/guests"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET company/{id}/guests`


<!-- END_3d0601c017fd18931a777e60fda326e5 -->

<!-- START_6226a0c6e487bc1918f6e85b9c828951 -->
## company/{id}/accounts
> Example request:

```bash
curl -X GET \
    -G "http://localhost/company/1/accounts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/company/1/accounts"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET company/{id}/accounts`


<!-- END_6226a0c6e487bc1918f6e85b9c828951 -->

<!-- START_fac6174d2c527846c6c022969f94dddf -->
## company/{id}/spots
> Example request:

```bash
curl -X GET \
    -G "http://localhost/company/1/spots" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/company/1/spots"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET company/{id}/spots`


<!-- END_fac6174d2c527846c6c022969f94dddf -->

<!-- START_615847eb775a7aff65f91cc00e49e641 -->
## spot/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/spot/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/spot/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET spot/{id}`


<!-- END_615847eb775a7aff65f91cc00e49e641 -->

<!-- START_65779b1ed5ff3ceb54da8467f930b0b3 -->
## company/spot
> Example request:

```bash
curl -X POST \
    "http://localhost/company/spot" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/company/spot"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST company/spot`


<!-- END_65779b1ed5ff3ceb54da8467f930b0b3 -->

<!-- START_681ca911151efae6ac24f73f2adbd06c -->
## spot/{id}
> Example request:

```bash
curl -X PUT \
    "http://localhost/spot/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/spot/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT spot/{id}`


<!-- END_681ca911151efae6ac24f73f2adbd06c -->

<!-- START_ed2c898887b539ae8229bebbe7ffdac0 -->
## company/{id}/pages
> Example request:

```bash
curl -X GET \
    -G "http://localhost/company/1/pages" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/company/1/pages"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET company/{id}/pages`


<!-- END_ed2c898887b539ae8229bebbe7ffdac0 -->

<!-- START_54861e7cac0da614aecadfd368db0705 -->
## page
> Example request:

```bash
curl -X POST \
    "http://localhost/page" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/page"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST page`


<!-- END_54861e7cac0da614aecadfd368db0705 -->

<!-- START_8d197514323fbd7e9bac2b89724193c9 -->
## all/stats
> Example request:

```bash
curl -X GET \
    -G "http://localhost/all/stats" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/all/stats"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET all/stats`


<!-- END_8d197514323fbd7e9bac2b89724193c9 -->

<!-- START_3c11e5cb99e1c937bee17351b3a61325 -->
## all/stats/month
> Example request:

```bash
curl -X GET \
    -G "http://localhost/all/stats/month" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/all/stats/month"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET all/stats/month`


<!-- END_3c11e5cb99e1c937bee17351b3a61325 -->

<!-- START_0d0e34f52bb17205ab3f5338f1aec653 -->
## company/{id}/stats/month
> Example request:

```bash
curl -X GET \
    -G "http://localhost/company/1/stats/month" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/company/1/stats/month"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET company/{id}/stats/month`


<!-- END_0d0e34f52bb17205ab3f5338f1aec653 -->

<!-- START_78e9e97ce9108914607ba7da4d532a8e -->
## company/{id}/stats
> Example request:

```bash
curl -X GET \
    -G "http://localhost/company/1/stats" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/company/1/stats"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET company/{id}/stats`


<!-- END_78e9e97ce9108914607ba7da4d532a8e -->

<!-- START_9b88dfcd318be78b3f5313f7fe5741f1 -->
## spot/{id}/stats/month
> Example request:

```bash
curl -X GET \
    -G "http://localhost/spot/1/stats/month" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/spot/1/stats/month"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET spot/{id}/stats/month`


<!-- END_9b88dfcd318be78b3f5313f7fe5741f1 -->

<!-- START_e1a4da89ce7881f033f73bad031dd56e -->
## spot/{id}/stats
> Example request:

```bash
curl -X GET \
    -G "http://localhost/spot/1/stats" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/spot/1/stats"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET spot/{id}/stats`


<!-- END_e1a4da89ce7881f033f73bad031dd56e -->

<!-- START_97c416ac9711e2e82970c65041a354f0 -->
## device
> Example request:

```bash
curl -X POST \
    "http://localhost/device" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/device"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST device`


<!-- END_97c416ac9711e2e82970c65041a354f0 -->

<!-- START_3e56bead9c20830fddd68eda48bdc56a -->
## account
> Example request:

```bash
curl -X POST \
    "http://localhost/account" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/account"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST account`


<!-- END_3e56bead9c20830fddd68eda48bdc56a -->

<!-- START_62c09084921155416dc5e292b293a549 -->
## settings
> Example request:

```bash
curl -X GET \
    -G "http://localhost/settings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Invalid token",
    "code": 2
}
```

### HTTP Request
`GET settings`


<!-- END_62c09084921155416dc5e292b293a549 -->

<!-- START_36ad081f9741972c7a63fb2599a20fa5 -->
## settings
> Example request:

```bash
curl -X POST \
    "http://localhost/settings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST settings`


<!-- END_36ad081f9741972c7a63fb2599a20fa5 -->


