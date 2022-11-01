const authToken = () => {
    var Token = "";

    const TokenData = window.localStorage.getItem("Token");
    if (TokenData) {
        Token = JSON.parse(TokenData).access_token;
    }

    return Token;
};

export default authToken;
