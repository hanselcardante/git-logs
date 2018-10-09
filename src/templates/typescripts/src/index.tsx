import * as React from 'react';
import * as ReactDOM from 'react-dom';
import {ApiRequest, delay} from './Helpers';
import Result from "./Result";
//
// const handleKeyUpName = (e: any) => {
//     const name: string = e.currentTarget.value;
//     delay(() => {
//         const request = ApiRequest.send('get', 'logs', {name});
//         request.then((r) => {
//
//         });
//     }, 1000);
// }


interface Props {
    handleKeyUpName: any;
}

const Header = (props: Props) => {
    return (
        <div>
            <input type='text' name='directory' placeholder='App Directory' />
            <input type='text' name='name' placeholder='Name' onKeyUp={props.handleKeyUpName} />
            <input type='text' name='maxHours' placeholder='Max Hours' />
            <input type='text' name='Date' placeholder='Date ' />
        </div>
    );
}

const App = () => {
    return (
        <div>
            <App2/>
        </div>
    );
}

interface State {
    collectionItems: [];
};

class App2 extends React.Component <null, Props>{

    constructor(props){
        super(props);
        this.state = {collectionItems: []};
    }
    componentDidMount() {
        this.state = {collectionItems: []};
    }

    handleKeyUpName = (e: any) => {
        const name: string = e.currentTarget.value;
        delay(() => {
            const request = ApiRequest.send('get', 'logs', {name});
            request.then((response) => {
                this.setState({collectionItems: response})
            });
        }, 1000);
    }

    render() {
        return (
            <div>
                <Header handleKeyUpName={this.handleKeyUpName} />
                <Result collectionItems={this.state.collectionItems}/>
            </div>
        );
    }
}

ReactDOM.render(<App/>, document.getElementById('react-root'));
