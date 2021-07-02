import React, {Component} from "react";
import ReactDOM from 'react-dom';
import "./App.css";
import 'bootstrap/dist/css/bootstrap.min.css';
import SignUp from "./SignUp/SignUp";
import SignIn from "./SignIn/SignIn";
import Home from "./Home/Home";
import {BrowserRouter as Router, Route, NavLink, Redirect} from "react-router-dom";
import EntityList from "./Entity/EntityList";
import Entity from "./Entity/Entity";
import SeriesHistoryList from "./SeriesHistory/SeriesHistoryList";
import SeriesHistory from "./SeriesHistory/SeriesHistory";
import axios from "axios";

export default class App extends Component {

    constructor(props) {
        super(props);
        this.state = {
            redirect: false,
            login: null,
            user: null,
            isAdmin: false
        };
    }

    componentDidMount = async () => {
        setTimeout(() => {
            const login = localStorage.getItem("isLoggedIn");
            const user = JSON.parse(localStorage.getItem("userData"));
            const isAdmin = user ? user['is_admin'] : false;

            this.setState({
                login,
                user,
                isAdmin,
                redirect: true
            })}, 0)

    };

    render() {
        let navLink = (
            <div className="Tab">
                <NavLink to="/sign-in" activeClassName="activeLink" className="signIn">
                    Sign In
                </NavLink>
                <NavLink exact to="/" activeClassName="activeLink" className="signUp">
                    Sign Up
                </NavLink>
            </div>
        );

        return (
            <div className="App">
                {this.state.login ? (
                    this.state.isAdmin ? (
                            <Router>
                                <Route exact path="/" component={SignUp}/>
                                <Route exact path="/sign-in" component={SignIn}/>
                                <Route exact path="/series"
                                       render={(props) => <EntityList {...props} entityType={`series`}/>}/>
                                <Route exact path="/series/new/"
                                       render={(props) => <Entity {...props} entityType={`series`}/>}/>
                                <Route exact path="/series/edit/:id"
                                       render={(props) => <Entity {...props} entityType={`series`}/>}/>
                                <Route exact path="/platforms"
                                       render={(props) => <EntityList {...props} entityType={`platforms`}/>}/>
                                <Route exact path="/platforms/new/"
                                       render={(props) => <Entity {...props} entityType={`platforms`}/>}/>
                                <Route exact path="/platforms/edit/:id"
                                       render={(props) => <Entity {...props} entityType={`platforms`}/>}/>
                            </Router>
                        )
                        : (
                            <Router>
                                <Route exact path="/" component={SignUp}/>
                                <Route exact path="/sign-in" component={SignIn}/>
                                <Route exact path="/series-history" component={SeriesHistoryList} />
                                <Route exact path="/series-history/new" component={SeriesHistory} />
                                <Route exact path="/series-history/edit/:id" component={SeriesHistory} />
                            </Router>
                        )
                ) : (
                    <Router>
                        {navLink}
                        <Route exact path="/" component={SignUp}/>
                        <Route path="/sign-in" component={SignIn}/>
                    </Router>
                )}
            </div>
        );
    }
}

ReactDOM.render(<App/>, document.getElementById('app'));

