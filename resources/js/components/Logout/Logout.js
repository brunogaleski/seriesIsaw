import React, { Component } from "react";
import { Redirect } from "react-router-dom";

export default class Logout extends Component {
    state = {
        navigate: false,
    };

    onLogoutHandler = () => {
        localStorage.clear();
        this.setState({
            navigate: true,
        });
    };
    render() {
        const { navigate } = this.state;
        if (navigate) {
            return <Redirect to="/" push={true} />;
        }
        return (
                <button
                    className="btn btn-outline-success my-2 my-sm-0"
                    onClick={this.onLogoutHandler}
                >
                    Logout
                </button>
        );
    }
}
