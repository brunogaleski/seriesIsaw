import React, {Component} from "react";
import {Alert, Button, Col, Container, Form, Row, Table} from "reactstrap";
import axios from "axios";
import {Link, Redirect} from "react-router-dom";
import {AiFillDelete, FaRegEdit} from "react-icons/all";
import Menu from "../Menu/Menu";

export default class SeriesHistoryList extends Component {

    constructor(props) {
        super(props);
        this.state = {
            history: [],
            series: [],
            platforms: [],
            errMsg: '',
            status: '',
            message: ''
        };
    }

    componentDidMount = async () => {
        this.getEntities('series');
        this.getEntities('platforms');
        try {
            const res = await axios.get(`/api/series-history`);
            this.setState({
                status: this.props.location.status,
                message: this.props.location.message,
                history: res.data['seriesHistoryList'].data
            });
        } catch (error) {
            this.setState({
                status: 'failed',
                message: error
            })
        }
        console.log('component mounted')
    };

    handleDelete = event => {
        event.preventDefault();
        const id = event.target['series_history_id'].value;
        axios.delete(`/api/series-history/${id}`)
            .then(res => {
                this.setState({
                    status: res.data.status,
                    message: res.data.message,
                    history: res.data['seriesHistoryList'].data
                })
            })
            .catch(error => {
                this.setState({
                    status: 'failed',
                    message: error
                })
            })
    }

    getEntityNameById = (entityType, entityId) => {
        if (entityType === 'series')  {
            return this.state.series.find(series => series.id === entityId).name;
        } else if (entityType === 'platforms') {
            return this.state.platforms.find(platform => platform.id === entityId).name;
        }
    }

    getEntities = entityType => {
        axios.get(`/api/${entityType}`)
            .then(res => {
                if (entityType === 'series') {
                    this.setState({
                        series: res.data['seriesList'].data
                    })
                } else if (entityType === 'platforms') {
                    this.setState({
                        platforms: res.data['platformsList'].data
                    })
                }
            })
            .catch(error => {
                console.error(error);
            })
    }


    render() {
        const login = localStorage.getItem("isLoggedIn");

        if (!login) {
            return <Redirect to="/sign-in"/>;
        }

        return (
            <Container>
                <Menu />

                {this.state.status  && <Alert color={this.state.status === 'success' ? 'success' : 'danger'}>{this.state.message}</Alert>}

                <Row>
                    <Col sm={{ size: '4' }}><h3>Series History</h3></Col>
                    <Col sm={{ size: '4', offset: 4 }}>
                        <Link to={{pathname: '/series-history/new', isEditMode: false}}>
                            <Button color='success' alt='New' title='New'>New</Button>
                        </Link>
                    </Col>
                </Row>

                <Table responsive striped hover>
                    <thead>
                    <tr>
                        <th>Series</th>
                        <th>Platform</th>
                        <th>Current Season</th>
                        <th>Current Episode</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {this.state.history.map((history) => {
                        return (
                            <tr key={history.id}>
                                <td key={'s' + history.series_id}>{this.getEntityNameById('series', history.series_id)}</td>
                                <td key={'p' + history.platform_id}>{this.getEntityNameById('platforms', history.platform_id)}</td>
                                <td key={'cs' + history.current_season}>{history.current_season}</td>
                                <td key={'ce' + history.current_episode}>{history.current_episode}</td>
                                <td key={history.id}  className="media">
                                    <Link to={{pathname: `/series-history/edit/${history.series_history_id}`, history: history, isEditMode: true}}>
                                        <Button color="primary" alt="Edit" title="Edit" className="mr-1">
                                            <FaRegEdit/>
                                        </Button>
                                    </Link>
                                    <Form onSubmit={this.handleDelete} className="inline m-0" action="" method="POST">
                                        <input name="series_history_id" id="series_history_id" value={history.series_history_id} readOnly hidden/>
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

