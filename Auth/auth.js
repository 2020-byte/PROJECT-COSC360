class User {

	constructor(username, email, user){
        this.username = username;
        this.email = email;
        this.user = user;
    }

    signOut() {
        this.username = null;
        this.email = null;
        this.user = false;
    }

    signIn(username,email, user) {
        this.username = username;
        this.email = email;
        this.user = user;
    }
}

class Auth extends User {

	constructor(auth){
        this.auth = auth;
    }
}


let user =  new User();
//user.signIn(1,1,true);
let auth =  false//new User('auth','auth@gmail.com','false');

