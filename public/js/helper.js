function isUserLogin()
{
    let accessToken = localStorage.getItem('access_token');

    if (accessToken === null) {
        return false;
    }

    let accessTokenParts = accessToken.split('.');
    let payload = JSON.parse(atob(accessTokenParts[1]));

    if (payload.exp <= Math.floor(Date.now() / 1000)) {
        return false;
    }

    return true;
}
