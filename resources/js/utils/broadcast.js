export const addChannel = function(clannelName, className, event)
{
    Echo.channel('laravel_database_' + clannelName).listen(className, event);
}