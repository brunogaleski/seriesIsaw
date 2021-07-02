import React, {Component} from "react";
import {Redirect} from "react-router-dom";
import {Alert, Button, Container, Form, FormGroup, Input, Label} from "reactstrap";
import axios from "axios";
import Menu from "../Menu/Menu";

export default class SeriesHistory extends Component {

    constructor(props) {
        super(props);
        this.state = {
            series: [],
            platforms: [],
            series_history_id: null,
            user_id: null,
            series_id: null,
            platform_id: null,
            current_episode: 1,
            current_season: 1,
            status: '',
            message: '',
            isEditMode: false,
            redirect: false
        };
    }

    componentDidMount() {
        const user = JSON.parse(localStorage.getItem("userData"));
        this.getEntities('series');
        this.getEntities('platforms');
        const isEditMode = this.props.location.isEditMode;
        if (isEditMode) {
            const { series_history_id, platform_id, series_id, current_episode, current_season }  = this.props.location.history;
            this.setState({
                series_history_id,
                platform_id,
                series_id,
                current_episode,
                current_season,
                isEditMode,
                user_id: user.id
            })
        } else {
            this.setState({
                isEditMode,
                user_id: user.id
            })
        }
    }

    onChange = event => {
        this.setState({[event.target.name]: event.target.value});
    }

    handleSubmit = event => {
        event.preventDefault();
        const {series_history_id, user_id, series_id, platform_id, current_episode, current_season, isEditMode} = this.state;
        axios.post(`/api/series-history/${isEditMode ? series_history_id : ''}`, {
            user_id,
            series_id,
            platform_id,
            current_episode,
            current_season
        })
            .then(res => {
                this.setState({
                    redirect: true,
                    status: res.data.status,
                    message: res.data.message
                })
            })
            .catch(error => {
                this.setState({
                    redirect: true,
                    status: 'failed',
                    message: error
                })
            })
    }

    getEntities = entityType => {
        const isEditMode = this.props.location.isEditMode;
        axios.get(`/api/${entityType}`)
            .then(res => {
                if (entityType === 'series') {
                    if (isEditMode) {
                        this.setState({
                            series: res.data['seriesList'].data
                        })
                    } else {
                        this.setState({
                            series: res.data['seriesList'].data,
                            series_id: res.data['seriesList'].data[0].id
                        })
                    }
                } else if (entityType === 'platforms') {
                    if (isEditMode) {
                        this.setState({
                            platforms: res.data['platformsList'].data
                        })
                    } else {
                        this.setState({
                            platforms: res.data['platformsList'].data,
                            platform_id: res.data['platformsList'].data[0].id
                        })
                    }
                }
            })
            .catch(error => {
                console.error(error);
            })
    }


    render() {
        if (this.state.redirect) {
            return <Redirect
                to={{pathname: '/series-history', status: this.state.status, message: this.state.message}}/>
        }
        const login = localStorage.getItem("isLoggedIn");
        if (!login) {
            return <Redirect to="/user-login"/>;
        }

        return (
            <Container>
                <Menu/>

                <h3>Series History</h3>

                <Form onSubmit={this.handleSubmit}>
                    <FormGroup>
                        <Label for="series_id">Series</Label>
                        <Input type="select" name="series_id" id="series_id" defaultValue={this.state.series_id || null}
                               onChange={this.onChange}>
                            {this.state.series.map((series) => {
                                return (
                                    <option key={series.id} value={series.id}>
                                        {series.name}
                                    </option>
                                )
                            })}
                        </Input>
                    </FormGroup>

                    <FormGroup>
                        <Label for="platform_id">Platform</Label>
                        <Input type="select" name="platform_id" id="platform_id" defaultValue={this.state.platform_id || null}
                               onChange={this.onChange}>
                            {this.state.platforms.map((platform) => {
                                return (
                                    <option key={platform.id} value={platform.id}>
                                        {platform.name}
                                    </option>
                                )
                            })}
                        </Input>
                    </FormGroup>

                    <FormGroup>
                        <Label for="current_season">Current Season</Label>
                        <Input type='number' name='current_season' id='current_season'
                               defaultValue={this.state.current_season} placeholder="Current Season"
                               onChange={this.onChange}/>
                    </FormGroup>

                    <FormGroup>
                        <Label for="current_episode">Current Episode</Label>
                        <Input type='number' name='current_episode' id='current_episode'
                               defaultValue={this.state.current_episode} placeholder="Current Episode"
                               onChange={this.onChange}/>
                    </FormGroup>


                    <Button color='success'>{this.state.isEditMode ? 'Update' : 'Create'}</Button>
                </Form>

                {this.state.status &&
                <Alert color={this.state.status === 'success' ? 'success' : 'danger'}>{this.state.message}</Alert>}
            </Container>
        );
    }
}
