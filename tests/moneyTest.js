import {formatCurrency} from '../scripts/utils/money.js';

console.log('--------------------------------');
console.log('test suite: formatCurrency start');
console.log('Converts cents into dollars')

if(formatCurrency(2095) === '20.95') {
	console.log('passed');
}else {
	console.log('failed');
}

console.log('works with 0');
if(formatCurrency(0) === '0.00') {
	console.log('passed');
}else {
	console.log('failed');
}

console.log('rounds up to nearest cents');
if(formatCurrency(2000.5) === '20.01') {
	console.log('passed');
}else {
	console.log('failed');
	console.log(formatCurrency(-2000.5));
}

console.log('round to nearest down cents');
if(formatCurrency(2000.4) === '20.00') {
	console.log('passed');
}else {
	console.log('failed');
	console.log(formatCurrency(2000.4));
}

console.log('test suite: formatCurrency end');
console.log('------------------------------');
