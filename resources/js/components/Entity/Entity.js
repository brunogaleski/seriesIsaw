import React, {Component} from "react";
import {Redirect} from "react-router-dom";
import {Alert, Button, Container, Form, FormGroup, Input, Label} from "reactstrap";
import axios from "axios";
import Menu from "../Menu/Menu";
import {capitalize} from "../../Utils";

export default class Entity extends Component {

    constructor(props) {
        super(props);
        this.state = {
            id: '',
            name: '',
            status: '',
            message: '',
            entityType: 'series',
            isEditMode: false,
            redirect: false
        };
    }

    componentDidMount() {
        this.setState({
            entityType: this.props.entityType,
            id: this.props.location.entity?.id || '',
            name: this.props.location.entity?.name || '',
            isEditMode: this.props.location.isEditMode
        })
    }

    onChange = event => {
        this.setState({ [event.target.name]: event.target.value });
    }

    handleSubmit = event => {
        event.preventDefault();
        const { id, name, entityType, isEditMode } = this.state
        axios.post(`/api/${entityType}/${isEditMode? id : ''}`, { name })
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

    render() {
        if (this.state.redirect) {
            return <Redirect to={{pathname: `/${this.state.entityType}`, status: this.state.status, message: this.state.message}} />
        }
        const login = localStorage.getItem("isLoggedIn");
        if (!login) {
            return <Redirect to="/user-login" />;
        }

        return (
            <Container>
                <Menu />

                <h3>{`${capitalize(this.state.entityType)} Edit`}</h3>

                <Form onSubmit={this.handleSubmit}>
                    <FormGroup>
                        <Label for="name">Name</Label>
                        <Input type="text" name="name" id="name" defaultValue={this.state.name || ''} onChange={this.onChange}  />
                    </FormGroup>

                    <Button color='success'>{this.state.isEditMode ? 'Update' : 'Create'}</Button>
                </Form>

                {this.state.status  && <Alert color={this.state.status === 'success' ? 'success' : 'danger'}>{this.state.message}</Alert>}
            </Container>
        );
    }
}
