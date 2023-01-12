// Ne fonctionne uniquement sous Linux. Sous Windows, certains includes seront erronées.
// Aussi mes commentaires sont en anglais parce que c'est mieux pour moi.
// On utilisera probablement jamais ce programme C sur notre site. Il est juste là pour remplir une contrainte imposée.
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <sys/stat.h>
#include <sys/un.h>
#include <unistd.h>
#include <fcntl.h>

// define constants for the FIFO and socket paths. This assumes you have writing rights to /tmp
#define FIFO_PATH "/tmp/shipping_fifo"
#define SOCK_PATH "/tmp/shipping_sock"

int main()
{
    // create the FIFO named pipe
    int res = mkfifo(FIFO_PATH, 0666);
    if (res == -1)
    {
        perror("Error creating FIFO");
        return 1;
    }

    // create the socket
    int sockfd = socket(AF_UNIX, SOCK_STREAM, 0);
    if (sockfd == -1)
    {
        perror("Error creating socket");
        return 1;
    }

    // bind the socket to the specified path
    struct sockaddr_un addr;
    memset(&addr, 0, sizeof(struct sockaddr_un));
    addr.sun_family = AF_UNIX;
    strncpy(addr.sun_path, SOCK_PATH, sizeof(addr.sun_path) - 1);

    res = bind(sockfd, (struct sockaddr*)&addr, sizeof(struct sockaddr_un));
    if (res == -1)
    {
        perror("Error binding socket");
        return 1;
    }

    // listen for connections on the socket
    res = listen(sockfd, 5);
    if (res == -1)
    {
        perror("Error listening on socket");
        return 1;
    }

    // accept a connection on the socket
    int clientfd = accept(sockfd, NULL, NULL);
    if (clientfd == -1)
    {
        perror("Error accepting connection on socket");
        return 1;
    }

    // open the FIFO for writing
    int fifofd = open(FIFO_PATH, O_WRONLY);
    if (fifofd == -1)
    {
        perror("Error opening FIFO for writing");
        return 1;
    }

    // simulate shipping by writing a message to the FIFO
    char *msg = "Shipping package...";
    res = write(fifofd, msg, strlen(msg));
    if (res == -1)
    {
        perror("Error writing to FIFO");
        return 1;
    }

    // close the FIFO and socket
    close(fifofd);
    close(sockfd);

    return 0;
}
