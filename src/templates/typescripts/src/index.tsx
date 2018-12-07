<<<<<<< HEAD
import * as React from "react";
import {render} from "react-dom";
import {AppContainer} from "react-hot-loader";
import App from "./components/App";

const rootEl = document.getElementById("root");

render(
    <AppContainer>
        <App/>
    </AppContainer>,
    rootEl
);

// Hot Module Replacement API
declare let module: { hot: any };

if (module.hot) {
    module.hot.accept("./components/App", () => {
        const NewApp = require("./components/App").default;

        render(
            <AppContainer>
                <NewApp/>
            </AppContainer>,
            rootEl
        );
    });
}
=======
import * as React from 'react';
import * as ReactDOM from 'react-dom';
import {ApiRequest, delay} from './Helpers';
import {LogProvider} from './LogContext';
import {Result} from "./Result";

interface Props {
    handleOnChange: (e: any, type: string) => void;
}

const Header = (props: Props) => {
    return (
        <div>
            <input type='text' name='directory' placeholder='App Directory' onChange={(e) => props.handleOnChange(e, 'directory')} />
            <input type='text' name='author' placeholder='Name' onChange={(e) => props.handleOnChange(e, 'name')} />
            <input type='text' name='maxHours' placeholder='Max Hours' onChange={(e) => props.handleOnChange(e, 'maxHours')}/>
            <input type='date' name='date' placeholder='Date ' onChange={(e) => props.handleOnChange(e, 'date')}/>
        </div>
    );
};

interface FormState {
    directory: string;
    author: string;
    maxHours: number;
    date: string;
}

interface State {
    collectionItems: [];
    form: FormState;
}

class App extends React.Component <any, State>{
    constructor(props: any){
        super(props);
        this.state = {collectionItems: [], form: {directory: '', author: '', maxHours: 0, date: ''}};
    }
    componentDidMount() {
        this.state = {collectionItems: [], form: {directory: '', author: '', maxHours: 0, date: ''}};
    }

    handleOnChange = (e: any) => {
        const fieldValue: string | number = e.currentTarget.value;
        const fieldName: string = e.currentTarget.name;

        this.state.form[fieldName] =  fieldValue;

        this.setState({form: this.state.form})

        delay(() => {
            const request = ApiRequest.send('get', 'logs', this.state.form);
            request.then((response) => {
                const items = JSON.parse(response);
                this.setState({collectionItems: items});
            });
        }, 100);
    }

    render() {
        return (
            <div>
                <Header handleOnChange={this.handleOnChange} />
                <LogProvider value={this.state.collectionItems}>
                    <Result />
                </LogProvider>
            </div>
        );
    }
}

ReactDOM.render(<App/>, document.getElementById('react-root'));
>>>>>>> dummy
