export const addChannel = function(channelName, className, event)
{
    Echo.channel('laravel_database_' + channelName).listen(className, event);
}

export const addIncreaseChannel = function(username, event)
{
    addChannel('increase_' + username, 'IncreaseMessage', event);
}