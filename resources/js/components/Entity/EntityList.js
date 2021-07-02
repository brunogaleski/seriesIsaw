import React, {Component} from "react";
import {Alert, Button, Col, Container, Form, Row, Table} from "reactstrap";
import axios from "axios";
import {Link, Redirect} from "react-router-dom";
import {AiFillDelete, FaRegEdit} from "react-icons/all";
import Menu from "../Menu/Menu";
import {capitalize} from "../../Utils";

export default class EntityList extends Component {

    constructor(props) {
        super(props);
        this.state = {
            entityType: '',
            entities: [],
            errMsg: '',
            status: '',
            message: ''
        };
    }

    componentDidMount = async () => {
        const entityType = this.props.entityType;
        this.setState({
            entityType: entityType
        });
        try {
            const res = await axios.get(`/api/${entityType}`);
            this.setState({
                status: this.props.location.status,
                message: this.props.location.message,
                entities: res.data[`${entityType}List`].data
            });
        } catch (error) {
            console.log(error)
            this.setState({
                status: 'failed',
                message: error
            })
        }
    };

    handleDelete = event => {
        event.preventDefault();
        const id = event.target['entityId'].value;
        axios.delete(`/api/${this.state.entityType}/${id}`)
            .then(res => {
                this.setState({
                    status: res.data.status,
                    message: res.data.message,
                    entities: res.data[`${this.state.entityType}List`].data
                })
            })
            .catch(error => {
                this.setState({
                    status: 'failed',
                    message: error
                })
            })
    }

    render() {
        let pageTitle = capitalize(this.state.entityType);
        const login = localStorage.getItem("isLoggedIn");

        if (!login) {
            return <Redirect to="/sign-in" />;
        }

        return (
            <Container>
                <Menu />

                {this.state.status  && <Alert color={this.state.status === 'success' ? 'success' : 'danger'}>{this.state.message}</Alert>}

                <Row>
                    <Col sm={{ size: '4' }}><h3>{pageTitle}</h3></Col>
                    <Col sm={{ size: '4', offset: 4 }}>
                        <Link to={{pathname: `${this.state.entityType}/new`, isEditMode: false}}>
                            <Button color='success' alt='New' title='New'>New</Button>
                        </Link>
                    </Col>
                </Row>

                <Table responsive striped hover>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {this.state.entities.map((entity) => {
                        return (
                            <tr key={entity.id}>
                                <td key={entity.id}>{entity.name}</td>
                                <td className="media">
                                    <Link to={{pathname: `/${this.state.entityType}/edit/${entity.id}`, entity: entity, isEditMode: true}}>
                                        <Button color="primary" alt="Edit" title="Edit" className="mr-1">
                                            <FaRegEdit/>
                                        </Button>
                                    </Link>
                                    <Form onSubmit={this.handleDelete} className="inline m-0" action="" method="POST">
                                        <input name="entityId" id="entityId" value={entity.id} readOnly hidden/>
                                        <Button color="danger" type="submit" alt="Delete" title="Delete">
                                            <AiFillDelete/>
                                        </Button>
                                    </Form>
                                </td>
                            </tr>
                        )
                    })}
                    </tbody>
                </Table>
            </Container>
        );
    }
}

