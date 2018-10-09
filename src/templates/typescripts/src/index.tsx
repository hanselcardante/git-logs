import * as React from 'react';
import * as ReactDOM from 'react-dom';
import {ApiRequest, delay} from './Helpers';
import Result from "./Result";

interface Props {
    handleKeyUp: (e: any, type: string) => void;
}

const Header = (props: Props) => {
    return (
        <div>
            <input type='text' name='directory' placeholder='App Directory' onKeyUp={(e) => props.handleKeyUp(e, 'directory')} />
            <input type='text' name='name' placeholder='Name' onKeyUp={(e) => props.handleKeyUp(e, 'name')} />
            <input type='text' name='maxHours' placeholder='Max Hours' onKeyUp={(e) => props.handleKeyUp(e, 'maxHours')}/>
            <input type='text' name='date' placeholder='Date ' onKeyUp={(e) => props.handleKeyUp(e, 'date')}/>
        </div>
    );
};

interface State {
    collectionItems: [];
}

class App extends React.Component <any, State>{
    constructor(props){
        super(props);
        this.state = {collectionItems: []};
    }
    componentDidMount() {
        this.state = {collectionItems: []};
    }

    handleKeyUp = (e: any, type: string) => {
        const value: string = e.currentTarget.value;
        delay(() => {
            const request = ApiRequest.send('get', 'logs', {value, type});
            request.then((response) => {
                this.setState({collectionItems: response})
            });
        }, 1000);
    }

    render() {
        return (
            <div>
                <Header handleKeyUp={this.handleKeyUp} />
                <Result collectionItems={this.state.collectionItems}/>
            </div>
        );
    }
}

ReactDOM.render(<App/>, document.getElementById('react-root'));
