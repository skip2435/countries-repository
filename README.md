### Some Important Notes

As of this moment 5/21/2023, I'm at a bit of a crossroad because I couldn't find an API For country safety data so I've decided to keep my current codebase as is
and move on with my next project. With that being said here is a rough outline of the code for this project. 

**Vue Components**

There are currently three Vue.js components in this project. First off is the CountrySearch which connects to the REST Countries API to return a country entered 
with error handling. The EconomicSearch component connects to the WorldBank API to return information related to economics although it is rough around the edges
because as of this moment the WorldBank country codes don't always work or the API isn't updated to display data for that country. Then the SafetySearch Vue
is in a weird spot because the WorldBank doesn't collect any data related to that topic. 

**Controllers**

The CountryController is what connects to the REST Countries API and then parses the data from JSON to a readable form on the webpage Vue component 
and the same applies to the WorldBankController except the API in this case is the WorldBank API and the controller is a little messy because it makes like 8 URL
calls to the API as well. 
