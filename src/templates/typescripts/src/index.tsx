import * as React from 'react';
import * as ReactDOM from 'react-dom';
import {ApiRequest, delay} from './Helpers';

const handleKeyUpName = (e: any) => {        
    const name: string = e.currentTarget.value;
    delay(() => {        
        const request = ApiRequest.send('get', 'logs', {name});
        request.then((r) => {
            console.log('response: ', r);
        });
    }, 1000);
}

const Header = () => {
    return (
        <div> 
            <input type='text' name='directory' placeholder='App Directory' />
            <input type='text' name='name' placeholder='Name' onKeyUp={handleKeyUpName} />
            <input type='text' name='maxHours' placeholder='Max Hours' />
            <input type='text' name='Date' placeholder='Date ' />
        </div>
    );
}

const Result = () => {
    return (
        <div>
            <h2>SPK 3423</h2> 
            <div>34h</div>
            <div>The quick brown fox</div>            
        </div>
    );
}

const App = () => {
	return (
		<div>
            <Header />
            <Result />
		</div>
	);
};

ReactDOM.render(<App />, document.getElementById('react-root'));