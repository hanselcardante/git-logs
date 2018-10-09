import * as React from 'react';
import * as ReactDOM from 'react-dom';

interface Props {
	name: string;
	age: number;
}

const getPerson = (person: Props) => {
	console.log(person.name);
	console.log(person.age);
	console.log('whoho');
}

const App = () => {
	return (
		<div>
			aadsaadfasdfds
		</div>
	);
};
console.log(document.getElementById('react-root'));
ReactDOM.render(<App />, document.getElementById('react-root'));