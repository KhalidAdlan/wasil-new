import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Portal extends Component {
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Welcome to portal</div>

                            <div className="card-body">I'm an example component!</div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('portal')) {
    ReactDOM.render(<Portal />, document.getElementById('portal'));
}
