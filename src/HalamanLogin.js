import React from 'react'
import './HalamanLogin.css'

const HalamanLogin = () => {
    return (
        <div className="bg">
            <div className="container">
                <div className="login-form">
                    <h1 className="title text-center">LOGIN</h1><br /><br />
                    <form id="login-form" method="post" className="form-signin" role="form">
                        <div className="text">Username
                            <input name="username" id="username" className="form-control" autofocus />
                        </div>
                        <br />
                        <div className="text">Password
                            <input name="password" id="password" type="password" className="form-control disable" />
                        </div>
                        <center>
                            <button className="btn btn-block bt-login text" type="submit">LOGIN</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    )
}

export default HalamanLogin
