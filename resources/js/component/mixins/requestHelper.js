import axios from "axios";

const user_check = localStorage.getItem("user");

const user = user_check ? JSON.parse(user_check) : {};

//local envinronment url

const url_domain = "http://127.0.0.1:8000";

//production url envinronment url

//const url_domain = "https://pristinesg.com"
//get authentication token

const getTokenRequest = () => {
    var Token = "";

    const TokenData = window.localStorage.getItem("Token");
    if (TokenData) {
        Token = JSON.parse(TokenData).access_token;
    }

    return Token;
};

const Request = {
    postMethod(action, object) {
        const url = url_domain + action;

        let formData = new FormData();

        // append your data
        for (var key in object) {
            //console.log(key)
            formData.append(key, object[key]);
        }

        // By Default Id and token

        // By Default added device type and login type in future use
        /*
        if (!socialLoginUser) {
            formData.append("login_by", config.LOGIN_BY);
        }
        */

        //formData.append("device_type", config.DEVICE_TYPE);
        //formData.append("device_token", config.DEVICE_TOKEN);

        return axios.post(url, formData, {
            headers: {
                Authorization: `Bearer ${getTokenRequest()}`,
            },
        });
    },

    getUser() {
        var User = {};

        const TokenData = window.localStorage.getItem("User");
        if (TokenData) {
            User = JSON.parse(TokenData);
        }

        return User;
    },

    getToken() {
        var Token = "";

        const TokenData = window.localStorage.getItem("Token");
        if (TokenData) {
            Token = JSON.parse(TokenData).access_token;
        }

        return Token;
    },

    getMethod(action) {
        const url = url_domain + action;

        return axios.get(url, {
            headers: {
                Authorization: `Bearer ${getTokenRequest()}`,
            },
        });
    },

    /*methods(action) {

        const url = apiUrl+'/api/'+action;

        return {
            getOne: ({ id }) => axios.get(`${url}/${id}`),
            getAll: (toGet) => axios.post(url, toGet),
            update: (toUpdate) =>  axios.put(url,toUpdate),
            create: (toCreate) =>  axios.put(url,toCreate),
            delete: ({ id }) =>  axios.delete(`${url}/${id}`)
        }
    }*/
};

export default Request;
