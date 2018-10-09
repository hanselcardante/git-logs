import * as React from 'react';
import * as ReactDOM from 'react-dom';
import {ApiRequest, delay} from './Helpers';

const handleKeyUp = (e: any, type: string) => {
    const value: string = e.currentTarget.value;
    delay(() => {        
        const request = ApiRequest.send('get', 'logs', {value, type});
        request.then((r) => {
            console.log('response: ', r);
        });
    }, 1000);
};

const Header = () => {
    return (
        <div> 
            <input type='text' name='directory' placeholder='App Directory' onKeyUp={(e) => handleKeyUp(e, 'directory')} />
            <input type='text' name='name' placeholder='Name' onKeyUp={(e) => handleKeyUp(e, 'name')} />
            <input type='text' name='maxHours' placeholder='Max Hours' onKeyUp={(e) => handleKeyUp(e, 'maxHours')}/>
            <input type='text' name='date' placeholder='Date ' onKeyUp={(e) => handleKeyUp(e, 'date')}/>
        </div>
    );
};

const Result = () => {
    return (
        <div>
            <h2>SPK 3423</h2> 
            <div>34h</div>
            <div>The quick brown fox</div>            
        </div>
    );
};

const App = () => {
	return (
		<div>
            <Header />
            <Result />
		</div>
	);
};

ReactDOM.render(<App />, document.getElementById('react-root'));