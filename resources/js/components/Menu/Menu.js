import React, {Component} from "react";
import {Link} from "react-router-dom";
import Logout from "../Logout/Logout";

export default class Menu extends Component {

    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        const user = JSON.parse(localStorage.getItem("userData"));
        const isAdmin = user ? user['is_admin'] : false;

        return (
            <nav className="navbar navbar-expand-lg navbar-light bg-light mb-3">
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    {isAdmin ? (
                        <ul className="navbar-nav mr-auto">
                            <li className="nav-item active">
                                <Link className="nav-link" to='/series'>
                                    Series
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to='/platforms'>
                                    Platforms
                                </Link>
                            </li>
                        </ul>
                    ) : (
                        <ul className="navbar-nav mr-auto">
                            <li className="nav-item">
                                <Link className="nav-link" to='/series-history'>
                                    Series History
                                </Link>
                            </li>
                        </ul>
                    )}
                    <Logout/>
                </div>
            </nav>
        );
    }
}
