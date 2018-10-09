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

<<<<<<< HEAD

interface Props {
    handleKeyUpName: any;
}
=======
const handleKeyUp = (e: any, type: string) => {
    const value: string = e.currentTarget.value;
    delay(() => {        
        const request = ApiRequest.send('get', 'logs', {value, type});
        request.then((r) => {
            console.log('response: ', r);
        });
    }, 1000);
};
>>>>>>> 23cae1e1311b910c80aef84ae15fd5710c081e9d

const Header = (props: Props) => {
    return (
<<<<<<< HEAD
        <div>
            <input type='text' name='directory' placeholder='App Directory' />
            <input type='text' name='name' placeholder='Name' onKeyUp={props.handleKeyUpName} />
            <input type='text' name='maxHours' placeholder='Max Hours' />
            <input type='text' name='Date' placeholder='Date ' />
=======
        <div> 
            <input type='text' name='directory' placeholder='App Directory' onKeyUp={(e) => handleKeyUp(e, 'directory')} />
            <input type='text' name='name' placeholder='Name' onKeyUp={(e) => handleKeyUp(e, 'name')} />
            <input type='text' name='maxHours' placeholder='Max Hours' onKeyUp={(e) => handleKeyUp(e, 'maxHours')}/>
            <input type='text' name='date' placeholder='Date ' onKeyUp={(e) => handleKeyUp(e, 'date')}/>
>>>>>>> 23cae1e1311b910c80aef84ae15fd5710c081e9d
        </div>
    );
};

const App = () => {
    return (
        <div>
            <App2/>
        </div>
    );
};

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
