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

<!-- START_278299cc2fed5516225810a606b320d6 -->
## add/session/auth
> Example request:

```bash
curl -X POST \
    "http://localhost/add/session/auth" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/add/session/auth"
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
`POST add/session/auth`


<!-- END_278299cc2fed5516225810a606b320d6 -->

<!-- START_f0170314e34a76866559b808df96adaa -->
## add/session/spot
> Example request:

```bash
curl -X POST \
    "http://localhost/add/session/spot" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/add/session/spot"
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
`POST add/session/spot`


<!-- END_f0170314e34a76866559b808df96adaa -->

<!-- START_33ec130004481ee8e84fd42a393f8ec2 -->
## test/call
> Example request:

```bash
curl -X POST \
    "http://localhost/test/call" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/test/call"
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
`POST test/call`


<!-- END_33ec130004481ee8e84fd42a393f8ec2 -->

<!-- START_1837277b153c14b6a1fc0d9dde8f3f61 -->
## test/sms
> Example request:

```bash
curl -X POST \
    "http://localhost/test/sms" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/test/sms"
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
`POST test/sms`


<!-- END_1837277b153c14b6a1fc0d9dde8f3f61 -->

<!-- START_468bf4c28f58d9a72c41ffb87cd2dd2f -->
## vouchers/{id}/generate
> Example request:

```bash
curl -X GET \
    -G "http://localhost/vouchers/1/generate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/vouchers/1/generate"
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
`GET vouchers/{id}/generate`


<!-- END_468bf4c28f58d9a72c41ffb87cd2dd2f -->

<!-- START_e3e5648c3148fbb2fb9e79b8f3949b60 -->
## vouchers/{id}/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/vouchers/1/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/vouchers/1/list"
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
`GET vouchers/{id}/list`


<!-- END_e3e5648c3148fbb2fb9e79b8f3949b60 -->

<!-- START_a7b17a8464052c9cf4416713dfe75a21 -->
## vouchers/{id}/spot
> Example request:

```bash
curl -X GET \
    -G "http://localhost/vouchers/1/spot" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/vouchers/1/spot"
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
`GET vouchers/{id}/spot`


<!-- END_a7b17a8464052c9cf4416713dfe75a21 -->

<!-- START_d59ba0b521919188f0463f5b2817d0e1 -->
## vouchers/{id}
> Example request:

```bash
curl -X PUT \
    "http://localhost/vouchers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/vouchers/1"
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
`PUT vouchers/{id}`


<!-- END_d59ba0b521919188f0463f5b2817d0e1 -->

<!-- START_09c047e89ff9e1bac5bbe5dc83060b80 -->
## list/{id}/vouchers
> Example request:

```bash
curl -X GET \
    -G "http://localhost/list/1/vouchers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/list/1/vouchers"
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
`GET list/{id}/vouchers`


<!-- END_09c047e89ff9e1bac5bbe5dc83060b80 -->

<!-- START_5a8685cf82efeb0275520a3c20b1e8a7 -->
## enter
> Example request:

```bash
curl -X POST \
    "http://localhost/enter" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/enter"
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
`POST enter`


<!-- END_5a8685cf82efeb0275520a3c20b1e8a7 -->

<!-- START_3906096641686fa2c7e7811c8aa3ce4c -->
## add
> Example request:

```bash
curl -X POST \
    "http://localhost/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/add"
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
`POST add`


<!-- END_3906096641686fa2c7e7811c8aa3ce4c -->

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

<!-- START_efada59788c3846d78703d1166b92617 -->
## guest/{id}/spot
> Example request:

```bash
curl -X GET \
    -G "http://localhost/guest/1/spot" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/guest/1/spot"
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
`GET guest/{id}/spot`


<!-- END_efada59788c3846d78703d1166b92617 -->

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

<!-- START_fb33dea8c2dc1cc8024d995df506957b -->
## spot/{id}/sms
> Example request:

```bash
curl -X GET \
    -G "http://localhost/spot/1/sms" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/spot/1/sms"
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
`GET spot/{id}/sms`


<!-- END_fb33dea8c2dc1cc8024d995df506957b -->

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

<!-- START_c9e8bea39cbe0e741b25f9b14aedae88 -->
## spot/{id}/event
> Example request:

```bash
curl -X GET \
    -G "http://localhost/spot/1/event" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/spot/1/event"
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
`GET spot/{id}/event`


<!-- END_c9e8bea39cbe0e741b25f9b14aedae88 -->

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

<!-- START_9bf55187824ff92cc42f1be52e862ab6 -->
## device/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/device/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/device/1"
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
`GET device/{id}`


<!-- END_9bf55187824ff92cc42f1be52e862ab6 -->

<!-- START_70574244918d7744e1a23584ce82c77d -->
## device/{id}/main
> Example request:

```bash
curl -X GET \
    -G "http://localhost/device/1/main" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/device/1/main"
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
`GET device/{id}/main`


<!-- END_70574244918d7744e1a23584ce82c77d -->

<!-- START_80aed9bceb94997a5f055e57a583f181 -->
## device/{id}/spots
> Example request:

```bash
curl -X GET \
    -G "http://localhost/device/1/spots" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/device/1/spots"
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
`GET device/{id}/spots`


<!-- END_80aed9bceb94997a5f055e57a583f181 -->

<!-- START_dc0c24420553e0faad904672797a8b5b -->
## device/{id}/sessions
> Example request:

```bash
curl -X GET \
    -G "http://localhost/device/1/sessions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/device/1/sessions"
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
`GET device/{id}/sessions`


<!-- END_dc0c24420553e0faad904672797a8b5b -->

<!-- START_3179a84830cc5015ec529b5cf1b91421 -->
## device/{id}/phones
> Example request:

```bash
curl -X GET \
    -G "http://localhost/device/1/phones" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/device/1/phones"
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
`GET device/{id}/phones`


<!-- END_3179a84830cc5015ec529b5cf1b91421 -->

<!-- START_ebb3ef2df5e44962ec1569895c1b1c2e -->
## device/{id}/events
> Example request:

```bash
curl -X GET \
    -G "http://localhost/device/1/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/device/1/events"
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
`GET device/{id}/events`


<!-- END_ebb3ef2df5e44962ec1569895c1b1c2e -->

<!-- START_ce19587bbf8c6ead41418d3c13e4a046 -->
## test/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/test/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/test/1"
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
`POST test/{id}`


<!-- END_ce19587bbf8c6ead41418d3c13e4a046 -->


